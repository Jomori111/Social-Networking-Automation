<?php
  $this->load->view("backend/header");

  $state = substr(str_shuffle("0123456789abcHGFRlki"), 0, 10);
  $url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=".LINKEDIN_CLIENT_ID."&redirect_uri=".LINKEDIN_REDIRECT_URI."&scope=".LINKEDIN_SCOPES."&state=".$state;
  $instagram_url = "https://api.instagram.com/oauth/authorize/?client_id=".INSTAGRAM_APP_ID."&redirect_uri=".INSTAGRAM_REDIRECT_URI."&response_type=code&scope=user_profile,user_media";

  require_once APPPATH.'../vendor/instagram/facebook/graph-sdk/src/Facebook/autoload.php';
  use Facebook\Facebook;
  use Facebook\Exceptions\FacebookResponseException;
  use Facebook\Exceptions\FacebookSDKException;

  $appId         = FACEBOOK_APP_ID;
  $appSecret     = FACEBOOK_APP_SECRET;
  $redirectURL   = FACEBOOK_REDIRECT_URI;
  $fbPermissions = array('email', 'public_profile');

  $fb = new Facebook(array(
      'app_id' => $appId,
      'app_secret' => $appSecret,
      'default_graph_version' => 'v5.0',
  ));

  $helper = $fb->getRedirectLoginHelper();

  $fbLoginURL = $helper->getLoginUrl($redirectURL, $fbPermissions);
?>
  <div class="page-body">
    
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Register Company</h5>
              <a class="btn btn-primary" href="builder_controller" style="float:right">Go to frontend</a>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group row">
                        <label class="col-lg-12 control-label text-lg-left" for="company_name">Company Name</label>  
                        <div class="col-lg-9">
                          <input name="company_name"  id = "company_name" type="text" placeholder="company name" class="form-control btn-square input-md">
                        </div>
                        <div class="col-lg-3">
                          <button type="button" class="btn btn-success" id = "add_company">Add</button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div id = "company_table"></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-8">
                  <div class="row">
                    <?php foreach($company as $key => $com){?>
                      <div class="col-xl-4 xl-50 col-6 hospital-patients">
                        <div class="card o-hidden">
                          <div class="card-body">
                            <div class="hospital-widgets media">
                              
                              <div class="media-body">
                                <div class="hospital-box">
                                  <button class="btn btn-pill btn-outline-primary btn-air-primary" onclick = "show_social(<?=$com['id']?>)">View</button>
                                </div>
                                <div class="hospital-content">
                                  <h3 class="d-inline-block f-w-600"><?=$com['name']?></h3>
                                </div>
                                <div class="flowers">
                                  <div class="flower1 flower-primary"></div>
                                  <div class="flower2 flower-primary"></div>
                                  <div class="flower3 flower-primary"></div>
                                </div>
                              </div>
                              
                            </div>
                          </div>
                        </div>
                      </div>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



  <input type="hidden" data-toggle="modal" id = "hidden_modal_btn" data-original-title="test" data-target="#exampleModal">
  <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
              <div class="card social-widget-card">
                <div class="card-body">
                  <div class="redial-social-widget radial-bar-100" data-label="100%"><i class="fa fa-linkedin font-primary"></i></div>
                  <h5 class="b-b-light">linkedin</h5>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;display: none" id = "linkedin_verified">
                      <button class="btn btn-pill btn-primary btn-air-primary disabled" disabled="true" type="button" >√ Verified</button>
                    </div>
                    <div class="col-md-12" style="text-align: center;display: none"  id = "linkedin_verify">
                      <a class="btn btn-pill btn-primary btn-air-primary active" href="<?php echo $url; ?>">Verify</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
              <div class="card social-widget-card">
                <div class="card-body">
                  <div class="redial-social-widget radial-bar-100" data-label="100%"><i class="fa fa-facebook font-primary"></i></div>
                  <h5 class="b-b-light">Facebook</h5>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;display: none" id = "facebook_verified">
                      <button class="btn btn-pill btn-primary btn-air-primary disabled" disabled="true" type="button" >√ Verified</button>
                    </div>
                    <div class="col-md-12" style="text-align: center;display: none"  id = "facebook_verify">
                      <a class="btn btn-pill btn-primary btn-air-primary active" href="<?=$fbLoginURL?>">Verify</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
              <div class="card social-widget-card">
                <div class="card-body">
                  <div class="redial-social-widget radial-bar-100" data-label="50%"><i class="fa fa-twitter font-primary"></i></div>
                  <h5 class="b-b-light">Twitter</h5>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;display: none" id = "twitter_verified">
                      <button class="btn btn-pill btn-primary btn-air-primary disabled" disabled="true" type="button" >√ Verified</button>
                    </div>
                    <div class="col-md-12" style="text-align: center;display: none"  id = "twitter_verify">
                      <a class="btn btn-pill btn-primary btn-air-primary active" href="admin_company/verify_twitter">Verify</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-sm-6 col-xl-3 xl-50 col-lg-6 box-col-6">
              <div class="card social-widget-card">
                <div class="card-body">
                  <div class="redial-social-widget radial-bar-100" data-label="50%"><i class="fa fa-instagram font-primary"></i></div>
                  <h5 class="b-b-light">Instagram</h5>
                  <div class="row">
                    <div class="col-md-12" style="text-align: center;display: none" id = "instagram_verified">
                      <button class="btn btn-pill btn-primary btn-air-primary disabled" disabled="true" type="button" >√ Verified</button>
                    </div>
                    <div class="col-md-12" style="text-align: center;display: none"  id = "instagram_verify">
                      <a class="btn btn-pill btn-primary btn-air-primary active" href="<?=$instagram_url?>">Verify</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
  $this->load->view("backend/footer");
?>

<script src="assets/frontend/js/company.js"></script>
