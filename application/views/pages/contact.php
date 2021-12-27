
<!-- Small Breadcrumb -->
      <div class="small-breadcrumb">
         <div class="container">
            <div class=" breadcrumb-link">
               <ul>
                  <li><a href="{base_url}">{language=home}</a></li>
                  <li><a class="active" href="{current_url}">{language=contact}</a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- Small Breadcrumb -->
      <!-- =-=-=-=-=-=-= Transparent Breadcrumb End =-=-=-=-=-=-= -->
      <!-- =-=-=-=-=-=-= Main Content Area =-=-=-=-=-=-= -->
      <div class="main-content-area clearfix">
         <!-- =-=-=-=-=-=-= Latest Ads =-=-=-=-=-=-= -->
         <section class="section-padding ">
            <!-- Main Container -->
            <div class="container">
               <!-- Row -->
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 no-padding commentForm">
                     <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="">
                           <h2>{language=send_message}</h2>

                           <form method="post"  action="{base_url}/post/contact" class="contact-form">
                              <div class="row">
                                 <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <input type="text" placeholder="{language=name}" id="name" name="name" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                       <input type="text" placeholder="{language=email_or_telegram}" id="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                       <input type="text" placeholder="{language=subject}" id="subject" name="subject" class="form-control" required>
                                    </div>
                                 </div>
                                 <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div class="form-group">
                                       <textarea cols="12" rows="7" placeholder="{language=message}..." id="message" name="message" class="form-control" required></textarea>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <button class="btn btn-theme" type="submit">{language=send}</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="contactInfo">
                           <h2>{language=contact_infortions}</h2>
                           <div class="singleContadds">
                              <i class="fa fa-map-marker"></i>
                              <p>
                                 {setting=contact_address}
                              </p>
                           </div>
                           <div class="singleContadds phone">
                              <i class="fa fa-phone"></i>
                              <p>
                                 {setting=contact_number}
                              </p>
                           </div>
                           <div class="singleContadds">
                              <i class="fa fa-envelope"></i>
                              <p>{setting=contact_email}</p>
                           </div>
                            <div class="singleContadds">
                              <i class="fa fa-telegram"></i>
                              <p>{setting=contact_telegram}</p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Row End -->
            </div>
            <!-- Main Container End -->
         </section>
         <!-- =-=-=-=-=-=-= Ads Archives End =-=-=-=-=-=-= -->