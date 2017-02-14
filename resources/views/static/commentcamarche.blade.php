@extends('layouts.app')

@section('comment-ca-marche')
active
@endsection

@section('content')
<hr/>
<p class="exemple"><i class="fa fa-cogs" aria-hidden="true"></i> Comment ça marche ?</p>
<hr/>

<!-- Start Onglet -->

	@if (session('status'))
		<div class="col-md-12">
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        </div>
    @endif
    <div class="container">
	<div class="row">
		<div class="col-md-12">
			<!-- Nav Tabs -->
			<ul class="nav nav-tabs">
	      <li @if(!old('email') && (!$tab || $tab == 'comment-ca-marche'))class="active comment-ca-marche"@else class="comment-ca-marche"@endif><a class="comment-ca-marche" href="?tab=comment-ca-marche" ><i class="icon-award-1"></i>Comment ça marche</a></li>
	      <li @if($tab == 'tarifs') class="active tarifs"@else class="tarifs"@endif ><a class="tarifs" href="?tab=tarifs" ><i class="icon-beaker"></i>Tarifs</a></li>
	      <li @if($tab == 'securite') class="active securite"@else class="securite"@endif ><a class="securite" href="?tab=securite" ><i class="icon-droplet"></i>Sécurité</a></li>
	      <li @if($tab == 'conditions-generales') class="active conditions-generales"@else class="conditions-generales"@endif ><a class="conditions-generales" href="?tab=conditions-generales"><i class="icon-droplet"></i>Conditions Générales</a></li>
	      <li @if($tab == 'partenaires') class="active partenaires"@else class="partenaires"@endif ><a class="partenaires" href="?tab=partenaires" ><i class="icon-droplet"></i>Partenaires</a></li>
	      <li @if(old('email') || $tab == 'contact')class="active contact"@else class="contact"@endif><a class="contact" href="?tab=contact" ><i class="icon-droplet"></i>Contactez-nous</a></li>
	      <li @if($tab == 'professionnels-du-vin')class="active professionnels-du-vin"@else class="professionnels-du-vin"@endif><a class="professionnels-du-vin" href="?tab=professionnels-du-vin"><i class="icon-droplet"></i>Professionnels du vin</a></li>
			</ul>

			<!-- Tab Panels -->
			<div class="tab-content">
				<!-- Tab 1 - Comment ça marche -->
				<div @if(!old('email') && (!$tab || $tab == 'comment-ca-marche'))class="tab-pane fade in active" @else class="tab-pane fade" @endif id="comment-ca-marche">
					<div class="article-content-body article-list-figure">
						<ul class="row list-figure">
							<li class="col-md-6 list-figure-item">
								<figure class="list-figure-figure figure-1">
									<figcaption class="list-figure-caption"><strong><!-- 1. Je créé --></strong></figcaption>
									<img class="list-figure-img" src="{{ URL::asset('/images/jecree.png') }}" alt="Ouvrez votre compte VinoTeam">
								</figure>
								<p class="list-figure-explanation">Ouvrez votre compte et invitez vos amis à rejoindre votre VinoTeam</p>
							</li>
							<li class="col-md-6 list-figure-item">
								<figure class="list-figure-figure figure-2">
									<figcaption class="list-figure-caption"><strong><!-- 2. J&#39;invite --></strong></figcaption>
									<img class="list-figure-img" src="{{ URL::asset('/images/jinvite.png') }}" alt="Invitez vos amis à rejoindre votre VinoTeam">
								</figure>
								<p class="list-figure-explanation">Partagez vos bons plans avec vos amis et centralisez facilement leurs commandes.</p>
							</li>
							<li class="col-md-6 list-figure-item">
								<figure class="list-figure-figure figure-3">
									<figcaption class="list-figure-caption"><strong><!-- 3. Je collecte --></strong></figcaption>
									<img class="list-figure-img" src="{{ URL::asset('/images/jedepense.png') }}" alt="Achetez du vin pour vos amis ou demandez-leur de vous acheter du vin où vous voulez">
								</figure>
								<p class="list-figure-explanation">Faites des économies en achetant groupé où vous voulez (foire aux vins, internet, vigneron…)
								</p>
							</li>
							<li class="col-md-6 list-figure-item">
								<figure class="list-figure-figure figure-4">
									<figcaption class="list-figure-caption"><strong><!-- 4. Je d&#233;pense --></strong></figcaption>
									<img class="list-figure-img" src="{{ URL::asset('/images/jecollecte.png') }}" alt="Remboursez-vous ou remboursez-les immédiatement et sans prise de tête.">
								</figure>
								<p class="list-figure-explanation">Plus de prise de tête pour récupérer l’argent ou gérer l’inventaire des achats. Avec VinoTeam tout est facile !
								</p>
							</li>
						</ul>
					</div>
				</div>
				<!-- Tab 2 - Tarifs -->
				<div @if($tab == 'tarifs')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="tarifs">
          <div class="container">
              <div class="row">
                  <img class="col-md-6" src="{{ URL::asset('/images/securite01.jpg') }}">
                  <div class="col-md-5">
                      <p>Avec VinoTeam vous allez pouvoir faire des économies en organisant facilement des achats groupés de vin ! Notre service est très simple&nbsp;:</p>
                      <ul class="icons-list">
                      <li><i class="fa fa-check"></i> Création de compte gratuite</li>
                      <li><i class="fa fa-check"></i> Pas d&rsquo;abonnement</li>
                      <li><i class="fa fa-check"></i> Pas d&rsquo;engagement</li>
                      <li><i class="fa fa-check"></i> Pas de frais sur les remboursements que vous recevez</li>
                      <li><i class="fa fa-check"></i> Et votre premier remboursement à un ami est gratuit !</li>
                      </ul>
                      <p>Celui qui a payé pour le groupe récupère la somme qu’il a avancée. Ceux qui le remboursent acquittent un petit frais de gestion à partir de leur deuxième utilisation de VinoTeam :</p>
											<ul class="icons-list">
                      <li><i class="fa fa-check"></i> 2.5% pour les virements de plus de 300€</li>
                      <li><i class="fa fa-check"></i> 3% pour les virements de 150€ à 300€</li>
                      <li><i class="fa fa-check"></i> 3.5% pour les virements de moins de 150€ ou les remboursements par carte bancaire</li>
                      </ul>
                  </div>
              </div>
          </div>
          <br/>
          <div class="row">
              <div class="col-md-12">
                  <p><p>Ce frais de gestion est inférieur à ceux de tous les services de cagnotte en ligne. Il est minime comparé aux belles économies réalisées grâce à l’achat groupé. Et Vinoteam est tellement plus pratique que n’importe quelle autre solution !</p>
                  <p>Prenons un exemple.</p>
              </div>
              <div>
                  <div class="col-md-6" style="vertical-align: middle; margin-top:20px;">
                      <p>Fred ach&egrave;te pour Rom&eacute;o pour 100&euro; deux caisses d&rsquo;un vin qu&rsquo;il n&eacute;gocie &agrave; -20% dans le cadre d&rsquo;un achat group&eacute; qu&rsquo;il fait pour sa VinoTeam. Rom&eacute;o rembourse Fred, qui re&ccedil;oit donc 100&euro;, soit le prix qu&rsquo;il a pay&eacute; pour acheter le vin de Rom&eacute;o. Quant &agrave; Rom&eacute;o, il paiera 103.5&euro;. Mais c&rsquo;est toujours plus avantageux pour lui que de payer ce m&ecirc;me vin 120&euro;&nbsp;!</p>
                      <p>Rom&eacute;o a donc fait une &eacute;conomie de 16.5&euro;&nbsp;en demandant &agrave; Fred de lui acheter du vin et en le remboursant facilement avec VinoTeam&nbsp;! Et Fred aura aussi &eacute;conomis&eacute; 20&euro;, parce qu&rsquo;il n&rsquo;aurait jamais pu obtenir ce tarif imbattable s&rsquo;il n&rsquo;avait pas achet&eacute; du vin pour Rom&eacute;o et sa VinoTeam&nbsp;!&nbsp;</p>
                  </div>
                  <div class="col-md-5">
                      <iframe class="col-md-6" src="https://www.youtube.com/embed/ubMl2TDCaaU" frameborder="0" allowfullscreen></iframe>
                  </div>
                  <div style="clear:both";></div>
              </div>
              <div class="col-md-12">
                  <p style="margin-top:20px;">Alors n&rsquo;h&eacute;sitez plus&nbsp;! Plus de compta, plus de prise de t&ecirc;te, comptez sur vos amis pour vous acheter des bons vins au bon prix&nbsp;!</p>
              </div>
          </div>
        </div>

        <!-- Tab 3 - Sécurité -->
        <div @if($tab == 'securite')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="securite">
          <div class="container">
             <div class="row">
                  <img class="col-md-5" src="{{ URL::asset('/images/tarif02.jpg') }}">
                  <div class="col-md-6">
                      <p>En plus de tous les outils qui permettent de g&eacute;rer facilement un achat group&eacute; de vin, VinoTeam vous permet recevoir des remboursements de la part des membres de votre Vinoteam.</p>
                      <p>Ceux-ci peuvent vous rembourser par virement VinoTeam ou par carte bancaire.<br /> Pour r&eacute;cup&eacute;rer les sommes qui vous sont dues, vous devrez avoir renseign&eacute; les coordonn&eacute;es bancaires o&ugrave; nous pouvons vous les transf&eacute;rer (IBAN).</p>
                  </div>
              </div>
              <br/>
              <div class="row">
                  <div class="col-md-6">
                      <p>Les sommes qui transitent par VinoTeam sont totalement s&eacute;curis&eacute;es.<br /> Un remboursement ne peut �tre effectu&eacute; qu&rsquo; &agrave; l&rsquo;initiative d&rsquo;un membre du groupe et avec l&rsquo;accord de celui auquel il est adress&eacute;.<br /> Il est obligatoire de valider chaque transaction.</p>
                      <p>Les plus haut standards de s&eacute;curit&eacute; s&rsquo;appliquent &agrave; toutes les transactions que vous r&eacute;alisez.<br /> Vos coordonn&eacute;es bancaires sont en lieu s&ucirc;r.<br />
                      <ul>
                          <li>Elles ne sont pas dans les serveurs VinoTeam.</li>
                          <li>Elles sont chiffr&eacute;es et conserv�es &agrave; distance dans un coffre-fort num&eacute;rique.</li>
                          <li>Vos donn&eacute;es personnelles et bancaires ne sont jamais communiqu&eacute;es, ni aux membres de votre VinoTeam, ni &agrave; aucune autre personne.</li>
                      </ul></p>
                  </div>
                  <img class="col-md-5" src="{{ URL::asset('/images/securite02.jpg') }}">
              </div>
              <br/>
              <div class="row">
                  <img class="col-md-5" src="{{ URL::asset('/images/securite03.jpg') }}">
                  <div class="col-md-6">
                      <p>Lorsque vous recevez un remboursement, cet argent vous appartient dans la seconde qui suit son paiement par le membre de votre VinoTeam. La repr&eacute;sentation num&eacute;rique de ce paiement transite sur un compte bancaire de cantonnement g&eacute;r&eacute; par les &eacute;tablissements Cr&eacute;dit Mutuel Ark&eacute;a et ING Luxembourg, avant d&rsquo;&ecirc;tre revers&eacute; sur votre compte bancaire.</p>
                      <p>Cette op&eacute;ration de paiement est ex&eacute;cut&eacute;e au plus tard deux jours ouvr&eacute;s suivant la date du remboursement si l&rsquo;utilisateur dispose d&eacute;j&agrave; d&rsquo;un Compte VinoTeam. Le cas &eacute;ch&eacute;ant, la date de r&eacute;ception est report&eacute;e &agrave; l&rsquo;ouverture du compte ou au jour de la collecte par un nouveau membre de votre VinoTeam. Si la date du remboursement n&rsquo;est pas un jour ouvr&eacute;, elle sera effectu&eacute;e le jour ouvr&eacute; suivant pour tout ordre pass&eacute; apr&egrave;s 12h.</p>
                      <p>Pour en savoir plus, vous pouvez consulter les conditions g&eacute;n&eacute;rales d&rsquo;utilisation de MangoPay, l&rsquo;op&eacute;rateur de paiement partenaire de VinoTeam, en t&eacute;l&eacute;chargeant le fichier PDF ci-dessous.</p>
                  </div>
              </div>
              <div class="row text-center">
                  <br/>
                  <a href="{{ URL::asset('/files/Mangopay_Terms-FR.pdf') }}"><img style="width:10%; height:10%;" src="{{ URL::asset('/images/CG.jpg') }}"></a>
              </div>
          </div>
        </div>

        <!-- Tab 4 - Conditions Générales -->
        <div @if($tab == 'conditions-generales')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="conditions-generales">
          <div class="container">
						<div class="row">
							 <div class="col-md-11">
                <p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri; background: white;" align="center"><span style="font-size: 13.5pt; font-family: Arial; color: #767676;">VinoTeam</span></p>
                <p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri; background: white;" align="center"><span style="font-size: 13.5pt; font-family: Arial; color: #767676;">Conditions G&eacute;n&eacute;rales d'Utilisation (CGU)</span></p>
                <p style="text-align: center; margin: 0cm 0cm 0.0001pt; font-size: 11pt; font-family: Calibri; background: white;" align="center"><span style="font-size: 13.5pt; font-family: Arial; color: #767676;">Version en date du 9 septembre 2016</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Le site vinoteam.fr est &eacute;dit&eacute; par la SAS VINEXPLORE, dont le si&egrave;ge social est situ&eacute; &agrave; l'adresse suivante : 150 Boulevard de Grenelle, 75015 Paris, et immatricul&eacute;e au RCS de Paris sous le num&eacute;ro n&deg;803846229 et propri&eacute;taire du nom commercial&nbsp;&laquo;&nbsp;VinoTeam&nbsp;&raquo;. Les dispositions suivantes ont pour objet de d&eacute;finir les conditions g&eacute;n&eacute;rales d&rsquo;utilisation de la plate-forme </span><a style="color: #0563c1; text-decoration: underline;" href="http://www.vinoteam.fr"><span style="font-size: 10.0pt; font-family: Arial;">www.vinoteam.fr</span></a></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Les CGU r&eacute;gissent exclusivement la relation entre la soci&eacute;t&eacute; Vinexplore et l&rsquo;utilisateur de la plateforme. L&rsquo;utilisateur est r&eacute;put&eacute; les accepter sans r&eacute;serve &agrave; l&rsquo;ouverture de son compte. La soci&eacute;t&eacute; Vinexplore se r&eacute;serve le droit le droit de modifier ponctuellement les CGU. Les modifications seront applicables d&egrave;s leur mise en ligne.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Pour l&rsquo;application des pr&eacute;sentes CGU, les termes suivants sont employ&eacute;s&nbsp;: </span></p>
                <ul style="margin-bottom: 0cm;">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&laquo;&nbsp;Acheteur&nbsp;&raquo;&nbsp;: la personne qui a achet&eacute; des vins pour le compte d&rsquo;autrui, et en demande le remboursement du prix</span></li>
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&laquo;&nbsp;Propri&eacute;taire&nbsp;&raquo;&nbsp;: la personne pour le compte de laquelle les vins ont &eacute;t&eacute; achet&eacute;s, et qui les a rembours&eacute;s suite &agrave; une demande de remboursement effectu&eacute;e via la plateforme VinoTeam.</span></li>
                </ul>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">1. Objet du service</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Le site VinoTeam.fr permet &agrave; un particulier (ci-apr&egrave;s &laquo;&nbsp;Acheteur&nbsp;&raquo;) d'&ecirc;tre rembours&eacute; d&rsquo;achats de vins effectu&eacute;s pour le compte d&rsquo;un autre particulier (ci-apr&egrave;s &laquo;&nbsp;Propri&eacute;taire&nbsp;&raquo;) auquel il est li&eacute; via pr&eacute;l&egrave;vement bancaire en ligne. Il fournit &eacute;galement les services d&rsquo;une cave virtuelle permettant aux personnes li&eacute;es par pr&eacute;l&egrave;vement bancaire de savoir o&ugrave; sont conserv&eacute;s les vins qu&rsquo;ils ont rembours&eacute;s ou dont ils souhaitent confier la garde &agrave; un tiers. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="2">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">2. Informations l&eacute;gales</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Par application des dispositions de l'article 6 de la Loi n&deg; 2004-575 du 21 juin 2004 pour la confiance dans l'&eacute;conomie num&eacute;rique, il est pr&eacute;cis&eacute; dans cet article l'identit&eacute; des diff&eacute;rents intervenants dans le cadre de la r&eacute;alisation et de le suivi du service.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><a style="color: #0563c1; text-decoration: underline;" href="http://www.vinoteam.fr"><span style="font-size: 10.0pt; font-family: Arial;">www.vinoteam.fr</span></a><span style="font-size: 10.0pt; font-family: Arial; color: #767676;"> est &eacute;dit&eacute; par :<br /> VINEXPLORE, tel qu&rsquo;indiqu&eacute; ci-dessus.<br /> Courriel : contact@vinexplore.com.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Le directeur de publication du site est :<br /> Mr Vincent Chevrier.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Le site VinoTeam.fr est h&eacute;berg&eacute; par :<br /> la soci&eacute;t&eacute; OVH, dont le si&egrave;ge est situ&eacute; 2 Rue Kellermann, 59100 Roubaix</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">VinoTeam op&egrave;re des prestations de paiements fournies par la soci&eacute;t&eacute; MangoPay, dont l&rsquo;adresse est 59 Boulevard Royal, 2449 Luxembourg</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="3">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">3. Formation de la VinoTeam</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Une VinoTeam est d&eacute;finie comme la somme des personnes ayant accept&eacute; d&rsquo;&ecirc;tre en relation personnelle via la plateforme vinoteam.fr, et ayant de ce fait agr&eacute;&eacute; mutuellement la possibilit&eacute; de demander ou d&rsquo;effectuer des remboursements &agrave; l&rsquo;une quelconque de ces personnes. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">A l&rsquo;ouverture de son compte VinoTeam, l&rsquo;utilisateur peut inviter des personnes &agrave; rejoindre sa VinoTeam. Il peut aussi le faire &agrave; n&rsquo;importe quel moment en &eacute;mettant une demande de remboursement adress&eacute;e &agrave; une personne qui n&rsquo;est pas encore membre de sa VinoTeam. Cette derni&egrave;re peut alors ouvrir son propre compte VinoTeam et accept&eacute;e l&rsquo;invitation qui lui a &eacute;t&eacute; faite de rejoindre la VinoTeam de l&rsquo;utilisateur. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="4">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">4. Demande de remboursement</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Lorsqu&rsquo;il a achet&eacute; des vins pour le compte d&rsquo;un tiers ou d&rsquo;un membre de sa VinoTeam, l&rsquo;acheteur envoie &agrave; cette personne une demande de remboursement. Il peut sp&eacute;cifier dans sa demande de remboursement diverses informations sur les produits qu&rsquo;il a achet&eacute;s, qui seront ensuite utilis&eacute;es pour la gestion de la cave virtuelle du propri&eacute;taire. Il peut &eacute;galement joindre &agrave; son envoi une facture pour preuve de ses d&eacute;penses. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="5">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">5. Remboursement</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">La demande de remboursement parvient au propri&eacute;taire sous la forme d&rsquo;un courrier &eacute;lectronique. Le propri&eacute;taire accepte la demande de remboursement en validant celle-ci par un bouton figurant &agrave; cette fin dans ce courrier &eacute;lectronique. Suite &agrave; cette action&nbsp;: </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">- l&rsquo;acheteur re&ccedil;oit un courriel lui confirmant le remboursement&nbsp;;</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">- les &eacute;ventuels messages et pi&egrave;ces jointes li&eacute;s &agrave; cette transaction sont archiv&eacute;s dans l&rsquo;espace &laquo;&nbsp;remboursements&nbsp;&raquo; de l&rsquo;acheteur et du propri&eacute;taire</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">- les donn&eacute;es sur les produits achet&eacute;s qui ont &eacute;ventuellement &eacute;t&eacute; remplies par l&rsquo;acheteur sont transf&eacute;r&eacute;es dans sa cave virtuelle&nbsp;;</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="6">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">6. Commissions de gestion de la plateforme VinoTeam</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Afin de couvrir les frais d&eacute;coulant de l&rsquo;utilisation de prestations de paiement, VinoTeam pr&eacute;l&egrave;ve en sus de chaque remboursement une commission de gestion s&rsquo;&eacute;levant &agrave; 3,5% des sommes rembours&eacute;es. Cette somme est acquitt&eacute;e par le propri&eacute;taire &agrave; chaque remboursement qu&rsquo;il effectue &agrave; un acheteur, en sus de celui-ci. VinoTeam se r&eacute;serve le droit de modifier ses tarifs &agrave; tout moment en les publiant en ligne. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="7">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">7. Responsabilit&eacute; de la livraison des vins rembours&eacute;s</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">VINEXPLORE n'est pas une partie prenante dans la livraison effective de biens, et toutes disputes doivent &ecirc;tre r&eacute;solues directement entre les particuliers en relations via la plateforme VinoTeam.fr. </span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="8">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">8. Tol&eacute;rance </span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Il est express&eacute;ment convenu que toute tol&eacute;rance ou renonciation de VINEXPLORE dans l&rsquo;application de tout ou partie des engagements pr&eacute;vus dans les pr&eacute;sentes Conditions G&eacute;n&eacute;rales, quelles qu&rsquo;en aient pu &ecirc;tre la fr&eacute;quence et la dur&eacute;e, ne saurait valoir modification des pr&eacute;sentes Conditions G&eacute;n&eacute;rales, ni g&eacute;n&eacute;rer un droit quelconque.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="9">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">9. Invalidit&eacute; d&rsquo;une clause des pr&eacute;sentes conditions g&eacute;n&eacute;rales</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Dans l&rsquo;hypoth&egrave;se o&ugrave; une ou plusieurs clauses des pr&eacute;sentes Conditions G&eacute;n&eacute;rales d&rsquo;Utilisation deviendrait nulle (s), ill&eacute;gale (s) ou jug&eacute;e(s) inapplicable(s) pour quelque raison que ce soit, la validit&eacute;, la l&eacute;galit&eacute; ou l&rsquo;applicabilit&eacute; de tout autre stipulation des pr&eacute;sentes Conditions G&eacute;n&eacute;rales d&rsquo;Utilisation ne serait aucunement affect&eacute;e ou alt&eacute;r&eacute;e.</span></p>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">&nbsp;</span></p>
                <ol style="margin-bottom: 0cm;" start="10">
                <li><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">10. Loi applicable et juridiction comp&eacute;tente</span></li>
                </ol>
                <p style="margin: 0cm 0cm 0.0001pt; line-height: 15.8pt; font-size: 11pt; font-family: Calibri; background: white;"><span style="font-size: 10.0pt; font-family: Arial; color: #767676;">Les pr&eacute;sentes CGU sont soumises &agrave; l'application du droit fran&ccedil;ais. </span></p>
              </div>
						</div>
					</div>
				</div>
				<!-- Tab 6 - Partenaires -->
				<div @if($tab == 'partenaires')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="partenaires">
          <div class="article-content-body article-list-figure" style="margin-top:10px;">
            <ul class="row list-figure">
              <li class="col-md-6 list-figure-item" style="text-align:right;">
                <figure class="list-figure-figure figure-1">
                	<a href="http://www.vinexplore.com/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/vinexplore.png') }}" style="width: 26em;"></a>
                </figure>
              </li>
              <li class="col-md-5" style="text-align:left;font-size: 30px;line-height:35px;">
                <strong>Le vin est à vous ! Grâce à <a href="https://www.vinexplore.com/">vinexplore.com</a>, vous pouvez goûter des vins gratuitement, partout en France !</strong>
              </li>
            </ul>
          </div>

          <h2 class="list-figure-caption">En magasin</h2>
          <div class="article-content-body article-list-figure">
            <ul class="row list-figure">
	            <li class="col-md-6 list-figure-item">
                <figure class="list-figure-figure figure-1">
              		<a href="#"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/bacchus.png') }}"></a>
                </figure>
	            </li>

	            <li class="col-md-6 list-figure-item">
                <figure class="list-figure-figure figure-1">
              		<a href="#"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/vins-et-bieres.png') }}"></a>
                </figure>
	            </li>
            </ul>
          </div>

					<h2 class="list-figure-caption">Uniquement sur le web</h2>
                    <div class="article-content-body article-list-figure">
                        <ul class="row list-figure">
                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="http://www.avenuedesvins.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/avenue-des-vins.png') }}"></a>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-2">
                                    <a href="http://www.oenojet.com/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/oenojet.png') }}"></a>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-3">
                                    <a href="https://www.onsoccupeduvin.com/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/on-soccupe-du-vin.png') }}"></a>
                                </figure>
                            </li>
                        </ul>

                        <ul class="row list-figure">
                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="http://www.trocwine.com/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/trocwine.jpg') }}"></a>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-2">
                                    <a href="http://www.twil.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/twil.png') }}"></a>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-3">
                                    <a href="http://www.vinealove.com/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/vinealove.jpg') }}"></a>
                                </figure>
                            </li>
                        </ul>

                        <ul class="row list-figure">
                            <li class="col-md-6 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="http://metidia.com/vinoga/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/vinoga.png') }}"></a>
                                </figure>
                            </li>
                            <li class="col-md-6 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="http://metidia.com/vinoga/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/logo-Caveasy.jpg') }}"></a>
                                </figure>
                            </li>
                            <li class="col-md-6 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.idealwine.com" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/idealwine.png') }}"></a>
                                </figure>
                            </li>
                        </ul>
                    </div>

                    <h2 class="list-figure-caption">Salons de vignerons</h2>
                    <div class="article-content-body article-list-figure">
                        <ul class="row list-figure">
                            <li class="col-md-6 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                  <a href="http://www2.vigneron-independant.com" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/partenaires/vigneron-independant.png') }}"></a>
                                </figure>
                            </li>
                        </ul>
                    </div>

                </div>
				<!-- Tab 7 - Contactez-nous -->
				<div @if(old('email') || $tab == 'contact')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="contact">
                    <div class="container">
				        <div class="row">
                            <div class="col-md-4">
                                <p>N'hésitez pas à nous contacter pour toute question, et à nous proposer des idées d'améliorations de VinoTeam, au plus près de vos besoins !</p>
                                <br/>
                                <img class="service-center" src="{{ URL::asset('/images/mail.png') }}">
                            </div>
				            <div class="col-md-7">
				                <form class="form" role="form" method="POST" action="{{ url('/contact-nous') }}">
				                    {{ csrf_field() }}

		                            <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                                        @if(Auth::check())
                                        <input id="firstname" autocomplete="off" type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname}}" placeholder="Prénom">
                                        @elseif(old('firstname'))
                                        <input id="firstname" autocomplete="off" type="text" class="form-control" name="firstname" value="{{ old('firstname') }}" placeholder="Prénom">
                                        @else
                                        <input id="firstname" autocomplete="off" type="text" class="form-control" name="firstname" value="" placeholder="Prénom">
                                        @endif
	                                    @if ($errors->has('firstname'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('firstname') }}</strong>
	                                        </span>
	                                    @endif
		                            </div>

		                            <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                                        @if(Auth::check())
                                        <input id="lastname" autocomplete="off" type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname}}" placeholder="Nom">
                                        @elseif(old('lastname'))
                                        <input id="lastname" autocomplete="off" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" placeholder="Nom">
                                        @else
		                                <input id="lastname" autocomplete="off" type="text" class="form-control" name="lastname" value="" placeholder="Nom">
                                        @endif
	                                    @if ($errors->has('lastname'))
	                                        <span class="help-block">
	                                            <strong>{{ $errors->first('lastname') }}</strong>
	                                        </span>
	                                    @endif
		                            </div>

			                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        @if(Auth::check())
                                        <input id="email" autocomplete="off" type="email" class="form-control" name="email" value="{{ Auth::user()->email}}" placeholder="exemple@exemple.com">
                                        @elseif(old('email'))
                                        <input id="email" autocomplete="off" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="exemple@exemple.com">
                                        @else
                                        <input id="email" autocomplete="off" type="email" class="form-control" name="email" value="" placeholder="exemple@exemple.com">
                                        @endif

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
			                        </div>

			                        <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
			                            <input id="subject" autocomplete="off" type="text" class="form-control" name="subject" value="" placeholder="Sujet">

		                                @if ($errors->has('subject'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('subject') }}</strong>
		                                    </span>
		                                @endif
			                        </div>
			                        <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
		                                <textarea class="form-control" id="message" name="message" rows="6" placeholder="Contenu du mail"></textarea>
		                                @if ($errors->has('phone'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('phone') }}</strong>
		                                    </span>
		                                @endif
		                            </div>

			                        <div class="form-group">
			                            <div class="col-md-4 col-md-offset-5">
			                                <input type="hidden" name="parent_id" value="">
			                                <button type="submit" class="btn btn-default">
			                                    Envoyer
			                                </button>
			                            </div>
			                        </div>
			                    </form>
				           </div>
				        </div>
                    </div>
                </div>
                <!-- Tab 8 - Professionnels du vin -->
                <div @if($tab == 'professionnels-du-vin')class="tab-pane fade in active" @else class="tab-pane fade" @endif id="professionnels-du-vin">
                    <div class="article-content-body article-list-figure">
												<p>Professionnels, participez à la promotion de VinoTeam ! Choisissez l'image qui correspond le mieux à votre clientèle et libérez la capacité d'achat groupé de vos clients en l’affichant sur votre site web. Nous sommes à votre disposition si vous avez besoin de support technique : <a href="mailto:contact@vinoteam.fr">contact@vinoteam.fr</a></p>
                    </div>

                    <div class="article-content-body article-list-figure">
                        <ul class="row list-figure">
                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam01.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam01.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam02.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam02.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam03.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam03.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>
                        </ul>

                        <ul class="row list-figure">
                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam04.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam04.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam05.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam05.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>

                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam06.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam06.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>
                        </ul>

                        <ul class="row list-figure">
                            <li class="col-md-4 list-figure-item">
                                <figure class="list-figure-figure figure-1">
                                    <a href="https://www.vinoteam.fr/" target="_blank"><img class="list-figure-img" src="{{ URL::asset('/images/Vinoteam07.jpg') }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>
                                    <input type="text" readonly="readonly" class="form-control" value='<a href="https://www.vinoteam.fr" target="_blank"><img src="{{ URL::asset("/images/Vinoteam07.jpg") }}" alt="VinoTeam - Prenez-en pour vos amis !"></a>'>
                                </figure>
                            </li>
                        </ul>
                    </div>

                </div>

			</div>
		</div>
            </div><!-- End .row -->
    </div><!-- End .container -->
</div>

<hr/>
<p class="exemple">N'attendez plus</p>
<hr/>

<div class="container">
  <div class="row">
    <div class="call-action call-action-boxed clearfix" style="margin-bottom:20px;">
      <!-- Call Action Text -->
      <h2 class="primary col-md-10 col-sm-9 col-xs-12">L’achat groupé de vin devient facile ! Partagez vos bons plans vins. Centralisez les commandes de vos amis. Remboursez-vous de vos dépenses en un clic. <br />Faites des économies et faites-leur plaisir !</h2>
      <!-- Call Action Button -->
      <div class="button-side col-md-2 col-sm-3 col-xs-12" style="margin-top:4px;"><a href="{{ url('register') }}" class="btn-system btn-large">Je m'inscris</a></div>
    </div>
  </div>
</div> <!-- End Call Action -->

<br/>
@endsection
