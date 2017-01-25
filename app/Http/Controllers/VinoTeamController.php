<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Event;
use Mail;
use App\Events\VerifyIBAN;
use App\Events\InviteFriends;
use App\Repositories\UserRepository;
use App\Repositories\UserFriendshipRepository;

class VinoTeamController extends Controller
{
    protected $mangopay;
    protected $users;
    protected $users_friendship;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users, UserFriendshipRepository $users_friendship, \MangoPay\MangoPayApi $mangopay)
    {
        $this->middleware('auth');
        $this->users = $users;
        $this->mangopay = $mangopay;
        $this->users_friendship = $users_friendship;

        // $user = $request->user();
        //
        // if( $user->emailValidate != 1 ) {
        //   $this->redirect('/users/profile');
        // }
    }

    public function MaVinoTeamIndex(Request $request) {
      $currentUser = $request->user();

      $friends = $this->users_friendship->getFriendsOf($currentUser);

      return view('vinoteam.mavinoteamindex', [
        'currentUser' => $currentUser,
        'friends' => $friends
      ]);
    }

    public function SearchFriendsIndex(Request $request) {
      return view('vinoteam.searchfriendsindex', [
        'search' => 0
      ]);
    }

    public function SearchFriendsResults(Request $request) {
      // Step 1 : current user
      $currentUser = $request->user();

      // Step 2 : validation
      $this->validate($request, [
          'firstname' => 'string|max:255',
          'lastname' => 'string|max:255',
          'email' => 'email|max:255'
      ]);

      // Step 3 : datas
      $datas = $request->only('firstname', 'lastname', 'email');

      $results = $this->users->searchUsersByFirstnameLastnameEmail($currentUser, $datas['firstname'], $datas['lastname'], $datas['email']);

      foreach($results as $result) {
        $result->isFriendOf = ($this->users_friendship->isFriendOf($currentUser, $result)) ? 1 : 0;
      }

      return view('vinoteam.searchfriendsindex', [
        'currentUser' => $currentUser,
        'results' => $results,
        'search' => 1
      ]);
    }

    public function AjouterAmiAMaVinoTeam(Request $request, $id) {
      // Step 1 : current user
      $currentUser = $request->user();

      // Step 2 : verify the other user
      $user2 = \App\User::findOrFail($id);

      // Step 3 : are they friends already ?
      if( $this->users_friendship->isFriendOf($currentUser, $user2) ) {
        return redirect('ma-vinoteam')->with('errors', 'Vous êtes déjà amis avec '.$user2->firstname.' '.$user2->lastname);
      }

      // Step 4 : create friendship
      $this->users_friendship->createRelationshipFrom(\App\User::find($currentUser->id), \App\User::find($user2->id));

      return redirect('ma-vinoteam')->with('status', $user2->firstname.' '.$user2->lastname.' fait désormais partie de votre VinoTeam !');
    }

    public function SupprimerAmiDeMaVinoTeam(Request $request, $id) {
      // Step 1 : current user
      $currentUser = $request->user();

      // Step 2 : verify the other user
      $user2 = \App\User::findOrFail($id);

      // Step 3 : are they friends already ?
      if( !$this->users_friendship->isFriendOf($currentUser, $user2) ) {
        return redirect('ma-vinoteam')->with('errors', 'Vous n\'êtes amis avec ce membre.');
      }

      // Step 4 : delete friendship
      $wine = $this->users_friendship->deleteFriendship($currentUser, $user2);
      return redirect('ma-vinoteam')->with('status', $user2->firstname.' '.$user2->lastname.' ne fait désormais plus partie de votre VinoTeam !');
    }

    public function InviteFriendsIndex(Request $request) {
      $user = $request->user();

      Event::fire(new VerifyIBAN($user->id));

      $user = \App\User::find($user->id);

      return view('vinoteam.index', [
          'user' => $user,
      ]);
    }

    public function InviteFriends(Request $request) {
        // Step 1 : current user
        $user = $request->user();

        if($request->email == null){
            return redirect('/ma-vinoteam/inviter-des-amis/')->with('alerts', 'Vous devez rentrer au moins une adresse mail');
        }
        // Step 2 : validation
        $this->validate($request, [
            'email' => 'required|string',
            'message' => 'string'
        ]);

        // Step 3 : explode & logical
        $emails = explode(',', $request->email);

        $errors = "";
        foreach($emails as $email) {
            $email = trim($email);

            if( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
                return redirect('/ma-vinoteam/inviter-des-amis/')->with('alerts', 'Vous devez saisir des adresses de courriels valides.');
            }

            // If the mail is not registered in our database
            if( !$this->users->exist($email) ){
                $uid = \App\User::create([
                    'email' => $email,
                    'parent_id' => $user->id
                ])->id;

                Event::fire(new InviteFriends($user->id, $uid, $request->message));
            } else {
                $uid = $this->users->getId($email);
                $search_user = \App\User::find($uid[0]->id);

                if( $search_user->gender == 'O' ) {
                    $errors .= 'Votre ami '.$email.' a déjà reçu une notification à rejoindre VinoTeam. Il fait désormais parti de votre VinoTeam.';
                } else {
                    $errors .= 'Votre ami '.$search_user->firstname.' '. $search_user->lastname .' est déjà utilisateur de VinoTeam. Il fait désormais parti de votre VinoTeam.';
                }

                $uid = $uid[0]->id;
            }

            $this->users_friendship->createRelationshipFrom($user, \App\User::find($uid));
        }

        if( $errors != "" ) {
            return redirect('/ma-vinoteam/inviter-des-amis/')->with('alerts', $errors);
        } else {
            return redirect('/ma-vinoteam/inviter-des-amis/')->with('status', 'Invitation envoyée ! Invitez tous vos amis à rejoindre votre VinoTeam, partagez vos bons plans et faites des économies en achetant groupé !');
        }
    }

    public function BonPlanIndex(Request $request) {
      $currentUser = $request->user();

      $friends = $this->users_friendship->getFriendsOf($currentUser);

      return view('vinoteam.bonplanindex', [
        'currentUser' => $currentUser,
        'friends' => $friends
      ]);
    }

    public function ProposerBonPlan(Request $request) {
      // Step 1 : current user
      $user = $request->user();

      // Step 2 : validation
      $this->validate($request, [
          'message' => 'string|required'
      ]);

      // Step 2.1 Gestion des destinataires connus
      $destinataires = array();
      if(count($request->destinataires) >= 1) {
        foreach($request->destinataires as $dest) {
          if( !\App\User::find($dest) ) {
            return redirect('/proposer-un-bon-plan')->with('alerts', 'Ce membre n\'existe pas.');
          }
          $destinataires[] = $dest;
        }
      }

      // Step 2.2 Gestion des destinataires inconnus
      if( $request->newUsers != '' ) {
        $unknownList = explode(',', $request->newUsers);

        if(count($unknownList) >= 1) {
          foreach($unknownList as $email) {
            $email = trim($email);

            if( filter_var($email, FILTER_VALIDATE_EMAIL) ) {
              if( !$this->users->exist($email) ){
                $newUserId = \App\User::create([
                    'email' => $email,
                    'parent_id' => $user->id
                ])->id;

                Event::fire(new InviteFriends($user->id, $newUserId, $request->message));
              } else {
                $uid = $this->users->getId($email);
                $newUserId = $uid[0]->id;
              }

              $this->users_friendship->createRelationshipFrom(\App\User::find($user->id), \App\User::find($newUserId));

              $destinataires[] = $newUserId;
            } else {
              return redirect('/proposer-un-bon-plan')->with('alerts', 'Veuillez saisir des courriels valides.');
            }
          }
        }
      }

      // Step 3 : send the bon plan
      if(count($destinataires) == 0) {
        return redirect('/proposer-un-bon-plan')->with('alerts', 'Aucun contact valide n\'a été saisi.');
      }

      foreach($destinataires as $destinataire) {
        $dest = \App\User::find($destinataire);

        // If the destinataire is not registered
        Event::fire(new InviteFriends($user->id, $dest->id));

        Mail::send('emails.proposerBonPlan', ['user' => $user, 'destinataire' => $dest, 'bodyMessage' => $request->message], function($message) use ($dest, $user) {
            // From
            $message->from(config('vinoteam.noreplay_email'), config('vinoteam.sitename'));

            // Reply-To
            $message->replyTo($user->email, $user->firstname.' '.$user->lastname);

            // To
            $message->to($dest->email);

            // Subjects
            $message->subject($user->firstname.' '.$user->lastname.' vous propose un bon plan !');
        });
      }

      return redirect('/proposer-un-bon-plan')->with('status', 'Ce bon plan a été partagé avec le(s) membre(s) que vous avez sélectionnés.');
    }
}
