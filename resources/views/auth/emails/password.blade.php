<!-- resources/views/auth/password.blade.php -->
@extends('layouts.email')

@section('content')
			<table>
				<tr>
                <img src="https://www.vinoteam.fr/emails/photo.jpg" />
                <br/> <br/>
					<td>
						<h3>Mot de passe perdu</h3>
						<p>Bonjour {{ $user->firstname }} {{ $user->lastname }}<br />
						Il semblerait que vous ayez perdu votre mot de passe.<br /><br />
						Si ce n'est pas le cas, ignorez cet e-mail.<br />
						<br />
						Sinon, veuillez suivre le lien suivant <a href="{{ $link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}"> {{ $link }} </a>
						</p>
                        
						<!-- social & contact -->
						<table class="social" width="100%">
							<tr>
								<td>
									
									<!-- column 1 -->
									<table align="left" class="column">
										<tr>
											<td>				
												
												<h5>Suivez-nous :</h5>
												<p><a href="https://www.facebook.com/VinoTeam/" class="soc-btn fb">Facebook</a> <a href="https://twitter.com/vinoteam" class="soc-btn tw">Twitter</a> <a href="#" class="soc-btn gp">Google+</a></p>
											</td>
										</tr>
									</table><!-- /column 1 -->	
									
									<!-- column 2 -->
									<table align="left" class="column">
										<tr>
											<td>				
																			
												<h5 class="">Contact Info :</h5>												
												<p>Téléphone: <strong>00 01 02 03 04</strong><br/>
			    								Email: <strong><a href="emailto:contact@vinoteam.fr">contact@vinoteam.fr</a></strong></p>
			    
											</td>
										</tr>
									</table><!-- /column 2 -->
									
									<span class="clear"></span>	
									
								</td>
							</tr>
						</table><!-- /social & contact -->
						
					</td>
				</tr>
			</table>
@endsection