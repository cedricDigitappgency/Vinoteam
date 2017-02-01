<?php

namespace App\Repositories;

use App\User;
use App\UserFriendship;
use \Illuminate\Support\Facades\DB;

use Event;
use App\Events\PostCreateRelationship;

class UserFriendshipRepository
{
  public function getFriendsOf(User $user) {
    // On cherche les amis
    $friends = UserFriendship::where('user1Id', $user->id)
      ->orWhere('user2Id',$user->id)
      ->get();

    // On récupère uniquement les id qui sont pertinents
    $friendsList = array();
    foreach($friends as $friend) {
      if($friend->user1Id == $user->id)
        $friendsList[] = $friend->user2Id;
      else
        $friendsList[] = $friend->user1Id;
    }

    // On récupère les utilisateurs perinents
    $friendsCollection = array();
    foreach ($friendsList as $key => $value) {
      if( !isset($friendsCollection[$value]) ) {
        $friendsCollection[$value] = User::find($value);
      }
    }

    // On les affiches
    return $friendsCollection;
  }

  public function deleteFriendship(User $user1, User $user2) {
    UserFriendship::where([
      ['user1Id', '=', $user1->id],
      ['user2Id', '=', $user2->id],
    ])->delete();

    UserFriendship::where([
      ['user1Id', '=', $user2->id],
      ['user2Id', '=', $user1->id],
    ])->delete();

    return true;
  }

  public function deleteFriendsOf(User $user) {
    UserFriendship::where([
      ['user1Id', '=', $user->id],
    ])->delete();

    UserFriendship::where([
      ['user2Id', '=', $user->id],
    ])->delete();

    return true;
  }

  public function isFriendOf(User $user1, User $user2) {
    $count = UserFriendship::where('user1Id', '=', $user1->id)
      ->where('user2Id', '=', $user2->id)
      ->count();

    $count1 = UserFriendship::where('user2Id', '=', $user1->id)
      ->where('user1Id', '=', $user2->id)
      ->count();

    if( ($count+$count1) == 1 )
      return true;
    else
      return false;
  }

  public function searchFriendsOfUserBy3keys(User $user, $search_firstname = null, $search_lastname = null, $search_email = null) {
    // On cherche les amis
    $friends = UserFriendship::where('firstname', $search_firstname)
      ->orWhere('lastname',$search_lastname)
      ->orWhere('email',$search_email)
      ->get();

    // On récupère uniquement les id qui sont pertinents
    $friendsList = array();
    foreach($friends as $friend) {
      if($friend->user1Id == $user->id)
        $friendsList[] = $friend->user2Id;
      else
        $friendsList[] = $friend->user1Id;
    }

    // On récupère les utilisateurs perinents
    $friendsCollection = array();
    foreach ($friendsList as $key => $value) {
      if( !isset($friendsCollection[$value]) ) {
        $friendsCollection[$value] = User::find($value);
      }
    }

    // On les affiches
    return $friendsCollection;
  }

  public function createRelationshipFrom(User $user1, User $user2, $message = "") {
    if( $user1->id == $user2->id ) {
      return;
    }

    if( $this->isFriendOf($user1, $user2) ) {
      return;
    }

    UserFriendship::create([
      'user1Id' => $user1->id,
      'user2Id' => $user2->id
    ]);

    Event::fire(new PostCreateRelationship($user1->id, $user2->id, $message));
  }
}
