<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $current_user, $wpdb;
$readonly_class = '';
$readonly = 'readonly';
$edit_mode = false;
$wphrm_messages_changepassword_settings = $this->parentWPHRM->WPHRMGetMessage(29);
$wphrmGetPagePermissions = $this->parentWPHRM->WPHRMGetPagePermissions();
$wphrmUserRole = $this->parentWPHRM->WPHRMGetCurrentUserCall();
if($wphrmUserRole != 'administrator'){
if ((!in_array('manageOptionsEmployee', $wphrmGetPagePermissions) || in_array('manageOptionsEmployeeView', $wphrmGetPagePermissions))
        && (in_array('manageOptionsEmployee', $wphrmGetPagePermissions) || !in_array('manageOptionsEmployeeView', $wphrmGetPagePermissions))) {
     wp_redirect(esc_url($this->WPHRMGetDashboardPageUrl('dashboard')), 301); 
}
}
$this->WPHRMGetFrontHeader();
    if (isset($_REQUEST['employee_id']) && $_REQUEST['employee_id'] != '') {
       $wphrm_employee_edit_id = $_REQUEST['employee_id'];
       } 
else {
        $wphrm_employee_edit_id = $current_user->ID;
    }
    $userInformation = get_userdata( $wphrm_employee_edit_id );
    $wphrmEmployeeBasicInfo = $this->parentWPHRM->WPHRMGetUserDatas($wphrm_employee_edit_id, 'wphrmEmployeeInfo');
    $wphrmEmployeeDocumentsInfo = $this->parentWPHRM->WPHRMGetUserDatas($wphrm_employee_edit_id, 'wphrmEmployeeDocumentInfo');
    
    $resumeDir = '';
    if (isset($wphrmEmployeeDocumentsInfo['resume'] ) && $wphrmEmployeeDocumentsInfo['resume'] != '') {
        $rdirs = explode('/', $wphrmEmployeeDocumentsInfo['resume']);
        $resumeDir = $rdirs[count($rdirs) - 1];
    }
    $offerDir = '';
    if (isset($wphrmEmployeeDocumentsInfo['offerLetter'] ) && $wphrmEmployeeDocumentsInfo['offerLetter'] != '') {
        $rdirs = explode('/', $wphrmEmployeeDocumentsInfo['offerLetter']);
        $offerDir = $rdirs[count($rdirs) - 1];
    }
    $joiningDir = '';
    if (isset($wphrmEmployeeDocumentsInfo['joiningLetter'] ) && $wphrmEmployeeDocumentsInfo['joiningLetter'] != '') {
        $rdirs = explode('/', $wphrmEmployeeDocumentsInfo['joiningLetter']);
        $joiningDir = $rdirs[count($rdirs) - 1];
    }
    $contractDir = '';
    if (isset($wphrmEmployeeDocumentsInfo['contract'] ) && $wphrmEmployeeDocumentsInfo['contract'] != '') {
        $rdirs = explode('/', $wphrmEmployeeDocumentsInfo['contract']);
        $contractDir = $rdirs[count($rdirs) - 1];
    }
    $idProofDir = '';
    if (isset($wphrmEmployeeDocumentsInfo['IDProof'] ) && $wphrmEmployeeDocumentsInfo['IDProof'] != '') {
        $rdirs = explode('/', $wphrmEmployeeDocumentsInfo['IDProof']);
        $idProofDir = $rdirs[count($rdirs) - 1];
    }

    $wphrmEmployeeSalaryInfo = $this->parentWPHRM->WPHRMGetUserDatas($wphrm_employee_edit_id, 'wphrmEmployeeSalaryInfo');
    $wphrmEmployeeBankInfo = $this->parentWPHRM->WPHRMGetUserDatas($wphrm_employee_edit_id, 'wphrmEmployeeBankInfo');
    $wphrmEmployeeOtherInfo = $this->parentWPHRM->WPHRMGetUserDatas($wphrm_employee_edit_id, 'wphrmEmployeeOtherInfo');
    $wphrmDefaultDocumentsLabel = $this->parentWPHRM->WPHRMGetDefaultDocumentsLabel();
    $wphrmEmployeeFirstName = get_user_meta($wphrm_employee_edit_id, 'first_name', true);
    $wphrmEmployeeLastName = get_user_meta($wphrm_employee_edit_id, 'last_name', true);
    $wphrmHideShowEmployeeSectionSettings = $this->parentWPHRM->WPHRMGetSettings('WPHRMHideShowEmployeeSectionInfo');
    
    $wphrmremoveFormFields = $this->parentWPHRM->WPHRMGetSettings('removeFormFields');
if(isset($wphrmremoveFormFields['removeFormFields'])){
    $removeFormFields = $wphrmremoveFormFields['removeFormFields'];
}else{
    $removeFormFields = $this->parentWPHRM->remove_form_field;
}
?>
<div class="preloader">
<span class="preloader-custom-gif"></span>
</div>
<input type="hidden" class="documents-hide-id" value="<?php if (isset($wphrmHideShowEmployeeSectionSettings['documents-details'])){ echo $wphrmHideShowEmployeeSectionSettings['documents-details']; } ?>">
<input type="hidden" class="bank-account-hide-id" value="<?php if (isset($wphrmHideShowEmployeeSectionSettings['bank-account-details'])){ echo $wphrmHideShowEmployeeSectionSettings['bank-account-details']; } ?>">
<input type="hidden" class="other-details-id" value="<?php if (isset($wphrmHideShowEmployeeSectionSettings['other-details'])){ echo $wphrmHideShowEmployeeSectionSettings['other-details']; } ?>">
<input type="hidden" class="salary-details-id" value="<?php if (isset($wphrmHideShowEmployeeSectionSettings['salary-details'])){ echo $wphrmHideShowEmployeeSectionSettings['salary-details']; } ?>">
<div class="contentWrapper">
    <div class="wphrmContainer">
        
        <div class="row">
        <!-- mobile menu start -->
            <?php 
                $this->WPHRMRMobileMenu();
            ?>
        <!-- mobile menu end -->
<div class="col-md-12 col-sm-12 ">
    
    <div class="productCard"><?php _e('View Employee Informations', $this->textDomain); ?></div>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo esc_url($this->WPHRMGetDashboardPageUrl('dashboard')); ?>"><i class="fa fa-home"></i><?php _e('Home', $this->textDomain); ?><i class="fa fa-angle-right"></i></a></li>
                    <li><a href="<?php echo esc_url($this->WPHRMGetDashboardPageUrl('employee-list')); ?>"><?php _e('Employee', $this->textDomain); ?></a> </li>
                    <li> <i class="fa fa-angle-double-right"></i><strong><?php echo esc_html($wphrmEmployeeFirstName).' '.esc_html($wphrmEmployeeLastName); ?></strong></li>
                </ul>
            </div>
            <?php if (in_array('manageOptionsEmployee', $wphrmGetPagePermissions)) { ?>
                <a class="btn green " href="<?php echo $this->WPHRMGetDashboardPageUrl('employee-list') ?>"><i class="fa fa-arrow-left"></i><?php _e('Back', $this->textDomain); ?> </a>
               <?php if (isset($_REQUEST['page']) && $_REQUEST['page'] != 'wphrm-employee-info') { ?>
                <a class="btn green " href="<?php echo $this->WPHRMGetDashboardPageUrl('account') ?>?page=wphrm-employee-info&employee_id=<?php  echo esc_html($wphrm_employee_edit_id); ?>"><i class="fa fa-edit"></i><?php _e('Edit', $this->textDomain); ?> </a>
               <?php } else { ?>
                <a class="btn green " href="<?php echo $this->WPHRMGetDashboardPageUrl('employee-view') ?>?page=wphrm-employee-view-details&employee_id=<?php echo esc_html($wphrm_employee_edit_id); ?>"><i class="fa fa-eye"></i><?php _e('View', $this->textDomain); ?> </a>
            <?php } } ?>
            <div class="row ">
                <div class="col-md-6 col-sm-6">
                   <div class="portlet box purple-wisteria">
                        <div class="portlet-title">
                            <div class="caption"> <i class="fa fa-edit"></i><?php _e('Personal Details ', $this->textDomain); ?></div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success display-hide" id="personal_details_success">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <div class="alert alert-danger display-hide" id="error">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrm_employee_basic_info_form" enctype="multipart/form-data">
                                <input type="hidden" name="wphrm_employee_id" id="wphrm_employee_id"  value="<?php
                                if (isset($wphrm_employee_edit_id)) : echo esc_attr($wphrm_employee_edit_id);
                                endif;
                                ?> "/>
                                <div class="form-body">
                                    <div class="form-group">
									
                                        <label class="control-label col-md-4"><?php _e('Photo', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: auto;">
                                                    <?php if (isset($wphrmEmployeeBasicInfo['employee_profile']) && $wphrmEmployeeBasicInfo['employee_profile'] != '') { ?>
                                                        <img src="<?php if (isset($wphrmEmployeeBasicInfo['employee_profile'])) : echo esc_attr($wphrmEmployeeBasicInfo['employee_profile']);
                                                    endif; ?>" width="200"><br>
                                                        <?php
                                                    }else {
                                                        if (isset($wphrmEmployeeBasicInfo['wphrm_employee_gender']) && $wphrmEmployeeBasicInfo['wphrm_employee_gender'] == 'Male') {
                                                            ?>
                                                            <img src="<?php echo esc_attr(plugins_url('../assets/images/default-male.jpeg', __FILE__)); ?>" width="200">
                                                        <?php } else {
                                                            ?>
                                                            <img src="<?php echo esc_attr(plugins_url('../assets/images/default-female.jpeg', __FILE__)); ?>" width="200">  
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php _e('First Name', $this->textDomain); ?><span class="required"></span></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control"  name="wphrm_employee_fname" type="text" id="wphrm_employee_fname" value="<?php
                                                   if (isset($wphrmEmployeeFirstName ) && $wphrmEmployeeFirstName !='') : echo esc_attr($wphrmEmployeeFirstName);
                                                else : echo esc_html($userInformation->data->user_nicename);
                                                endif;
                                                   ?>" autocapitalize="none"  />
                                        </div>
                                    </div>
                                    <div class="form-group <?php if(!in_array('profile-last-name', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                        <label class="col-md-4 control-label"><?php _e('Last Name', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control" name="wphrm_employee_lname" type="text" id="wphrm_employee_lname" value="<?php
                                                   if (isset($wphrmEmployeeLastName)) : echo esc_attr($wphrmEmployeeLastName);
                                                   endif;
                                                   ?>" autocapitalize="none"  />
                                        </div>
                                    </div>
                                    <div class="form-group <?php if(!in_array('profile-father-name', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                        <label class="col-md-4 control-label"><?php _e('Father Name', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control" name="wphrm_employee_fathername" type="text" id="wphrm_employee_fathername" value="<?php
                                                   if (isset($wphrmEmployeeBasicInfo['wphrm_employee_fathername'])) : echo esc_attr($wphrmEmployeeBasicInfo['wphrm_employee_fathername']);
                                                   endif;
                                                   ?>" autocapitalize="none"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php _e('Email', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control" name="wphrm_employee_email" type="text" id="wphrm_employee_email" value="<?php
                                                  if (isset($wphrmEmployeeBasicInfo['wphrm_employee_email']) && $wphrmEmployeeBasicInfo['wphrm_employee_email'] !='') : echo esc_attr($wphrmEmployeeBasicInfo['wphrm_employee_email']);
                                                else : echo esc_html($userInformation->data->user_email); 
                                                endif;
                                                   ?>" autocapitalize="none"  />   
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    
                                    <?php
                                         $wphrmBankfieldskeyInfoss = $this->parentWPHRM->WPHRMGetSettings('wphrmemployeepersonalcustomInfo');
                                        if (isset($wphrmEmployeeBasicInfo['wphrmpersonalfieldslebal']) && $wphrmEmployeeBasicInfo['wphrmpersonalfieldslebal'] != '' && isset($wphrmEmployeeBasicInfo['wphrmpersonalfieldsvalue']) && $wphrmEmployeeBasicInfo['wphrmpersonalfieldsvalue'] != '') {
                                            foreach ($wphrmEmployeeBasicInfo['wphrmpersonalfieldslebal'] as $lebalkey => $wphrmEmployeeSettingsBank) {
                                                foreach ($wphrmEmployeeBasicInfo['wphrmpersonalfieldsvalue'] as $valuekey => $wphrmEmployeeSettingsvalue) {
                                                    if ($lebalkey == $valuekey && (isset($wphrmBankfieldskeyInfoss['Personalfieldslebal']) && in_array($wphrmEmployeeSettingsBank, $wphrmBankfieldskeyInfoss['Personalfieldslebal']))) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmEmployeeSettingsBank, $this->textDomain); ?></label>
                                                            <input name="personal-fields-lebal[]" type="hidden" id="personal-fields-lebal" value="<?php
                                                            if (isset($wphrmEmployeeSettingsBank)) : echo esc_attr($wphrmEmployeeSettingsBank);
                                                            endif;
                                                            ?>"/>
                                                            <div class="col-md-8">
                                                                <input class="form-control" disabled name="personal-fields-value[]" type="text" id="personal-fields-lebal" value="<?php
                                                                if (isset($wphrmEmployeeSettingsvalue)) : echo esc_attr($wphrmEmployeeSettingsvalue);
                                                                endif;
                                                                ?>" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                        <?php
                                                    }
                                                }
                                            }
                                            $wphrmBankFieldsInfo = $this->parentWPHRM->WPHRMGetSettings('wphrmemployeepersonalcustomInfo');
                                            if (!empty($wphrmBankFieldsInfo)) {
                                                foreach ($wphrmBankFieldsInfo['Personalfieldslebal'] as $wphrmBankFieldsSettings) {
                                                    if (!in_array($wphrmBankFieldsSettings, $wphrmEmployeeBasicInfo['wphrmpersonalfieldslebal'])) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmBankFieldsSettings, $this->textDomain); ?></label>
                                                            <input name="personal-fields-lebal[]" type="hidden" id="personal-fields-lebal" value="<?php
                                                            if (isset($wphrmBankFieldsSettings)) : echo esc_attr($wphrmBankFieldsSettings);
                                                            endif;
                                                            ?>"/>
                                                            <div class="col-md-8">
                                                                <input class="form-control" disabled name="personal-fields-value[]" type="text" id="personal-fields-lebal" value="" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                        <?php
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    
                                    
                                    
                                    <div class="form-group <?php if(!in_array('profile-phone-no', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                        <label class="col-md-4 control-label"><?php _e('Phone Number', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input  class="form-control" disabled name="wphrm_employee_phone" type="text" id="wphrm_employee_phone" value="<?php
                                                    if (isset($wphrmEmployeeBasicInfo['wphrm_employee_phone'])) : echo esc_attr($wphrmEmployeeBasicInfo['wphrm_employee_phone']);
                                                    endif;
                                                    ?>" autocapitalize="none" autocorrect="off" maxlength="10" />     
                                        </div>
                                    </div>
                                     <div class="form-group <?php if(!in_array('profile-date-birth', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                            <label class="control-label col-md-4"><?php _e('Date of Birth', $this->textDomain); ?></label>
                                            <div class="col-md-8">
                                                <div class="input-group input-medium date"  data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                    <input disabled="" class="form-control date-pickers"   type="text"  value="<?php
                                                    if (isset($wphrmEmployeeBasicInfo['wphrm_employee_bod'])) : echo  esc_attr($wphrmEmployeeBasicInfo['wphrm_employee_bod']);
                                                    endif;
                                                    ?>" autocapitalize="none"  />
                                                    <span class="input-group-btn">
                                                        <button class="btn default-date" type="button"><i class="fa fa-calendar" style="line-height: 1.9;"></i></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="form-group <?php if(!in_array('profile-local-address', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                        <label class="col-md-4 control-label"><?php _e('Local Address', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <textarea disabled rows="3" class="form-control"   name="wphrm_employee_local_address" type="text" id="wphrm_employee_local_address" value="" autocapitalize="none" autocorrect="off"><?php
                                                if (isset($wphrmEmployeeBasicInfo['wphrm_employee_local_address'])) : echo esc_textarea($wphrmEmployeeBasicInfo['wphrm_employee_local_address']);
                                                endif;
                                                ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group <?php if(!in_array('profile-permanent-address', $removeFormFields)){ echo 'remove-form-fileds'; } ?>">
                                        <label class="col-md-4 control-label"><?php _e('Permanent Address', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <textarea disabled rows="3" class="form-control"  name="wphrm_employee_permanant_address" type="text" id="wphrm_employee_permanant_address" value="" autocapitalize="none" autocorrect="off" ><?php
                                                if (isset($wphrmEmployeeBasicInfo['wphrm_employee_permanant_address'])) : echo esc_textarea($wphrmEmployeeBasicInfo['wphrm_employee_permanant_address']);
                                                endif;
                                                ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                    <div class="portlet box purple-wisteria documents-hide-div">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-file-image-o"></i><?php _e('Documents', $this->textDomain); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="portlet-body">
                                <div class="alert alert-success display-hide" id="employee_document">
                                    <button class="close" data-close="alert"></button>
                                </div>
                                <div class="alert alert-danger display-hide" id="employee_document_error">
                                    <button class="close" data-close="alert"></button>
                                </div>
                                <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrmEmployeeDocumentInfo_form" enctype="multipart/form-data"><input name="_method" type="hidden" value="PATCH"><input name="_token" type="hidden" value="CKw97QC4WEEKjxHdCpA3oZBiucWKYo0778rEpuPz">
                                    <input type="hidden" name="wphrm_employee_id" id="wphrm_employee_id"  value="<?php
                                           if (isset($wphrm_employee_edit_id)) : echo esc_attr($wphrm_employee_edit_id);
                                           endif;
                                           ?> "/>
                                    <div class="form-body">
                                       <div class="form-group">
                                                <label class="control-label col-md-4"><?php echo esc_html($wphrmDefaultDocumentsLabel['resume']); ?></label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large" >
                                                            <div disabled  class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                    <?php
                                                                    if (isset($resumeDir) && $resumeDir !='') : $resumeExt = pathinfo($resumeDir, PATHINFO_EXTENSION);
                                                                       echo esc_html(mb_strimwidth($resumeDir , 0, 10).'....'.$resumeExt);
                                                                    endif;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                               <div class="col-md-2">
                                                    <?php  if (isset($wphrmEmployeeDocumentsInfo['resume']) && $wphrmEmployeeDocumentsInfo['resume'] != ''){ ?>
                                                         <a class="blue color" target="blank" href="<?php  if (isset($wphrmEmployeeDocumentsInfo['resume'])) : echo esc_html($wphrmEmployeeDocumentsInfo['resume']); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                    <?php  }  ?>     
                                               </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4"><?php echo esc_html($wphrmDefaultDocumentsLabel['offerLetter']); ?></label>
                                                <div class="col-md-6">
                                                    <div  class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div  class="input-group input-large">
                                                            <div disabled class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                    <?php
                                                                   if (isset($offerDir) && $offerDir !='') : 
                                                                     $offerExt = pathinfo($offerDir, PATHINFO_EXTENSION);
                                                                echo esc_html(mb_strimwidth($offerDir , 0, 10).'....'.$offerExt);
                                                                    endif;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="col-md-2">
                                                    <?php  if (isset($wphrmEmployeeDocumentsInfo['offerLetter']) && $wphrmEmployeeDocumentsInfo['offerLetter'] != ''){ ?>
                                                         <a class="blue color" target="blank" href="<?php  if (isset($wphrmEmployeeDocumentsInfo['offerLetter'])) : echo esc_html($wphrmEmployeeDocumentsInfo['offerLetter']); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                         <?php  }  ?>   
                                                 </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4"><?php echo esc_html($wphrmDefaultDocumentsLabel['joiningLetter']); ?></label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div disabled class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                    <?php
                                                                     if (isset($joiningDir) && $joiningDir !='') : 
                                                                         $joiningDirExt = pathinfo($joiningDir, PATHINFO_EXTENSION);
                                                                echo esc_html(mb_strimwidth($joiningDir , 0, 10).'....'.$joiningDirExt);
                                                                    endif;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                               <div class="col-md-2">
                                                    <?php  if (isset($wphrmEmployeeDocumentsInfo['joiningLetter']) && $wphrmEmployeeDocumentsInfo['joiningLetter'] != ''){ ?>
                                                         <a class="blue color" target="blank" href="<?php  if (isset($wphrmEmployeeDocumentsInfo['joiningLetter'])) : echo esc_html($wphrmEmployeeDocumentsInfo['joiningLetter']); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                       <?php  }  ?>    
                                               </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4"><?php echo esc_html($wphrmDefaultDocumentsLabel['contractAndAgreement']); ?></label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div disabled class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename"><?php
                                                                   if (isset($contractDir) && $contractDir !='') :
                                                                         $contractDirExt = pathinfo($contractDir, PATHINFO_EXTENSION);
                                                                echo esc_html(mb_strimwidth($contractDir , 0, 10).'....'.$contractDirExt);
                                                                    endif;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                     <?php  if (isset($wphrmEmployeeDocumentsInfo['contract']) && $wphrmEmployeeDocumentsInfo['contract'] != ''){ ?>
                                                         <a class="blue color" target="blank" href="<?php  if (isset($wphrmEmployeeDocumentsInfo['contract'])) : echo esc_html($wphrmEmployeeDocumentsInfo['contract']); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                     <?php  }  ?>  
                                                  </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-4"><?php echo esc_html($wphrmDefaultDocumentsLabel['iDProof']); ?></label>
                                                <div class="col-md-6">
                                                    <div disabled class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div  disabled class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename"><?php
                                                                    if (isset($idProofDir) && $idProofDir !='') :
                                                                         $idProofDirExt = pathinfo($idProofDir, PATHINFO_EXTENSION);
                                                                echo esc_html(mb_strimwidth($idProofDir , 0, 10).'....'.$idProofDirExt);
                                                                    endif;
                                                                    ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <?php  if (isset($wphrmEmployeeDocumentsInfo['IDProof']) && $wphrmEmployeeDocumentsInfo['IDProof'] != ''){ ?>
                                                    <a class="blue color" target="blank" href="<?php  if (isset($wphrmEmployeeDocumentsInfo['IDProof'])) : echo esc_html($wphrmEmployeeDocumentsInfo['IDProof']); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                    <?php } ?></div>
                                                </div>
                                        <?php
                                           
                                            if (isset($wphrmEmployeeDocumentsInfo['documentsfieldslebal']) && $wphrmEmployeeDocumentsInfo['documentsfieldslebal'] != '' && isset($wphrmEmployeeDocumentsInfo['documentsfieldsvalue']) && $wphrmEmployeeDocumentsInfo['documentsfieldsvalue'] != '') 
                                            {
                                            foreach ($wphrmEmployeeDocumentsInfo['documentsfieldslebal'] as $lebalkey => $documentsfieldslebal) {
                                                foreach ($wphrmEmployeeDocumentsInfo['documentsfieldsvalue'] as $valuekey => $documentsfieldsvalue) {
                                                    if ($lebalkey == $valuekey) { 
                                                        ?>
                                               <div class="form-group">
                                                <label class="control-label col-md-4"><?php _e($documentsfieldslebal, $this->textDomain); ?></label>
                                                <div class="col-md-6">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <div class="input-group input-large">
                                                            <div disabled class="form-control uneditable-input" data-trigger="fileinput">
                                                                <i class="fa fa-file fileinput-exists"></i>&nbsp; <span class="fileinput-filename">
                                                                    <?php
                                                                    if (isset($documentsfieldsvalue) && $documentsfieldsvalue !='') : 
                                                                    $url =  $this->parentWPHRM->WPHRMGetAttechment($documentsfieldsvalue); 
                                                                    $title =  $this->parentWPHRM->WPHRMGetAttechmentTitle($documentsfieldsvalue);
                                                                    $resumeExt = pathinfo($url, PATHINFO_EXTENSION);
                                                                    echo esc_html(mb_strimwidth($title , 0, 20).'....'.$resumeExt);
                                                                    endif;
                                                                    ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-2">
                                                    <?php  if (isset($url) && $url!= ''){ ?>
                                                    <a class="blue color" target="blank" href="<?php  if (isset($url)) : echo esc_html($url); endif; ?>"><i class="fa fa-eye eye-class"></i></a>
                                                    <?php } ?></div>
                                            </div> <?php
                                                    }
                                                }
                                            }
                                           
                                        } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div></div>
                    <div class="col-md-6 col-sm-6">
                      <div class="portlet box red">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-key"></i><?php _e('Change Password', $this->textDomain); ?>
                                    </div>
                                    <div class="actions">
                                        <a href="javascript:;" onclick="jQuery('#wphrmChangePasswordInfo_form').submit();"  class="demo-loading-btn btn btn-sm btn-default ">
                                            <i class="fa fa-save" ></i> <?php _e('Save', $this->textDomain); ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="alert alert-success display-hide" id="wphrmChangePasswordInfo_success"><i class='fa fa-check-square' aria-hidden='true'></i> <?php echo esc_html($wphrm_messages_changepassword_settings); ?>
                                        <button class="close" data-close="alert"></button>
                                    </div>
                                    <div class="alert alert-danger display-hide" id="wphrmChangePasswordInfo_error">
                                        <button class="close" data-close="alert"></button>
                                    </div>
                                    <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrmChangePasswordInfo_form">   
                                        <div id="alert_bank"></div>
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-4 control-label"><?php _e('Current Password', $this->textDomain); ?></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="wphrm_current_password" type="password" id="wphrm_employee_bank_account_name" autocapitalize="none"  />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label"><?php _e('New Password', $this->textDomain); ?></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="wphrm_new_password" type="password" id="wphrm_new_password" autocapitalize="none"  />
                                                </div>
                                            </div>
                                            <div class="form-group margin-bottom-zero">
                                                <label class="col-md-4 control-label"><?php _e('Confirm Password', $this->textDomain); ?></label>
                                                <div class="col-md-8">
                                                    <input class="form-control" name="wphrm_conform_password" type="password" id="wphrm_conform_password" autocapitalize="none"  />
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <div class="portlet box red-sunglo  bank-account-hide-div">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bank"></i><?php _e('Bank Account Details', $this->textDomain); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success display-hide" id="wphrm_bank_details">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <div class="alert alert-danger display-hide" id="wphrm_bank_details_error">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrmEmployeeBankInfo_form">   
                                <input type="hidden" name="wphrm_employee_id" id="wphrm_employee_id"  value="<?php
                                       if (isset($wphrm_employee_edit_id)) : echo esc_attr($wphrm_employee_edit_id);
                                       endif;
                                       ?> "/>
                                <div id="alert_bank"></div>
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php _e('Account Holder Name', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control"  name="wphrm_employee_bank_account_name" type="text" id="wphrm_employee_bank_account_name" value="<?php
                                                   if (isset($wphrmEmployeeBankInfo['wphrm_employee_bank_account_name'])) : echo esc_attr($wphrmEmployeeBankInfo['wphrm_employee_bank_account_name']);
                                                   endif; ?>" autocapitalize="none"  />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php _e('Account Number', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <input disabled class="form-control"  name="wphrm_employee_bank_account_no" type="text" id="wphrm_employee_bank_account_no" value="<?php
                                                   if (isset($wphrmEmployeeBankInfo['wphrm_employee_bank_account_no'])) : echo esc_attr($wphrmEmployeeBankInfo['wphrm_employee_bank_account_no']);
                                                   endif; ?>" autocapitalize="none"  />
                                        </div>
                                    </div>
                                    <?php
                                        if (isset($wphrmEmployeeBankInfo['wphrmbankfieldslebal']) && $wphrmEmployeeBankInfo['wphrmbankfieldslebal'] != '' && isset($wphrmEmployeeBankInfo['wphrmbankfieldsvalue']) && $wphrmEmployeeBankInfo['wphrmbankfieldsvalue'] != '') {
                                            foreach ($wphrmEmployeeBankInfo['wphrmbankfieldslebal'] as $lebalkey => $wphrmEmployeeSettingsBank) {
                                                foreach ($wphrmEmployeeBankInfo['wphrmbankfieldsvalue'] as $valuekey => $wphrmEmployeeSettingsvalue) {
                                                    if ($lebalkey == $valuekey) { ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmEmployeeSettingsBank, $this->textDomain); ?></label>
                                                            <input disabled name="bank-fields-lebal[]" type="hidden"  value="<?php
                                                            if (isset($wphrmEmployeeSettingsBank)) : echo esc_attr($wphrmEmployeeSettingsBank); endif; ?>"/>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control" name="bank-fields-value[]" type="text"  value="<?php
                                                                if (isset($wphrmEmployeeSettingsvalue)) : echo esc_attr($wphrmEmployeeSettingsvalue); endif; ?>" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                    <?php }
                                                }
                                            }
                                            $wphrmBankFieldsInfo = $this->parentWPHRM->WPHRMGetSettings('Bankfieldskey');
                                            if (!empty($wphrmBankFieldsInfo)) {
                                                foreach ($wphrmBankFieldsInfo['Bankfieldslebal'] as $wphrmBankFieldsSettings) {
                                                    if (!in_array($wphrmBankFieldsSettings, $wphrmEmployeeBankInfo['wphrmbankfieldslebal'])) { ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmBankFieldsSettings, $this->textDomain); ?></label>
                                                            <input disabled name="bank-fields-lebal[]" type="hidden"  value="<?php
                                                            if (isset($wphrmBankFieldsSettings)) : echo esc_attr($wphrmBankFieldsSettings); endif; ?>"/>
                                                            <div disabled class="col-md-8">
                                                                <input disabled class="form-control" name="bank-fields-value[]" type="text"  value="" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                    <?php }
                                                }
                                            }
                                        }else {
                                            $wphrmBankfieldskeyInfo = $this->parentWPHRM->WPHRMGetSettings('Bankfieldskey');
                                            if (!empty($wphrmBankfieldskeyInfo)) {
                                                foreach ($wphrmBankfieldskeyInfo['Bankfieldslebal'] as $wphrmBanksettingInfo) { ?>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><?php _e($wphrmBanksettingInfo, $this->textDomain); ?></label>
                                                        <input disabled name="bank-fields-lebal[]" type="hidden"  value="<?php
                                                        if (isset($wphrmBanksettingInfo)) : echo esc_attr($wphrmBanksettingInfo); endif; ?>"/>
                                                        <div class="col-md-8">
                                                            <input disabled class="form-control" name="bank-fields-value[]" type="text" value="" autocapitalize="none"  />
                                                        </div>
                                                    </div> 
                                                <?php }
                                            }
                                        } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="portlet box red-sunglo other-details-div">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comment-o"></i><?php _e('Other Details', $this->textDomain); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success display-hide" id="other_details_success">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <div class="alert alert-danger display-hide" id="other_details_success_error">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrmEmployeeOtherInfo_form">   
                                <input type="hidden" name="wphrm_employee_id" id="wphrm_employee_id"  value="<?php
                                       if (isset($wphrm_employee_edit_id)) : echo esc_attr($wphrm_employee_edit_id);
                                       endif;
                                       ?> "/>
                                <div id="alert_bank"></div>
                                <div class="form-body">
                                    <?php
									$Expirydate1 = 0;
									$Expirydate2 = 0;
									$Expirydate3 = 0;
                                    if (in_array('manageOptionsEmployee', $wphrmGetPagePermissions)) {
                                        if (isset($wphrmEmployeeOtherInfo['wphrmotherfieldslebal']) && $wphrmEmployeeOtherInfo['wphrmotherfieldslebal'] != '' && isset($wphrmEmployeeOtherInfo['wphrmotherfieldsvalue']) && $wphrmEmployeeOtherInfo['wphrmotherfieldsvalue'] != '') {
                                            foreach ($wphrmEmployeeOtherInfo['wphrmotherfieldslebal'] as $lebalkey => $wphrmEmployeeSettingsOther) {
                                                foreach ($wphrmEmployeeOtherInfo['wphrmotherfieldsvalue'] as $valuekey => $wphrmOtherSettingsvalue) {
                                                    if ($lebalkey == $valuekey) {
														
                                                        ?>
														
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmEmployeeSettingsOther, $this->textDomain); ?></label>
															
                                                            <input disabled name="other-fields-lebal[]" type="hidden" value="<?php
                                                            if (isset($wphrmEmployeeSettingsOther)) : echo esc_attr($wphrmEmployeeSettingsOther);
                                                            endif;
                                                            ?>"/>
															<?php 
															
															if ($wphrmEmployeeSettingsOther == 'Visa Expiry date'){
															$date = str_replace('/', '-', $wphrmOtherSettingsvalue);
																
															//$Visa_date = strtotime(esc_attr($wphrmOtherSettingsvalue));
															$Visa_date = strtotime(date('Y-m-d', strtotime($date)));
															//$curdate = strtotime(date("d/m/Y"));
															$curdate = time();
															
															//echo "$Visa_date - $curdate ";
															//if(!empty($Visa_date) && (strtotime(date("d/m/Y",$Visa_date)) > strtotime(date("d/m/Y")))) {
															if(!empty($Visa_date) && ( $Visa_date < $curdate)) {
																$Expirydate1 = 1;
																//echo '<script> alert($wphrmEmployeeSettingsOther.": EXPIRED!")</script>'; 
																//echo " Todat is: ".date("d/m/Y")." and the VISA Expiry date is: ".date("d/m/Y",$Visa_date);
																//echo "Result: ".(strtotime(date("d/m/Y",$Visa_date)) < strtotime(date("d/m/Y")));
																?>
															
															<i style="color:red;" class="fa fa-id-card icon">EXPIRED!</i> 
															
															
															<?php 
															
															}
															} ?>
															<?php 
															
															if ($wphrmEmployeeSettingsOther == 'Passport Expiry date'){
															$date = str_replace('/', '-', $wphrmOtherSettingsvalue);
															$Passport_date = strtotime(date('Y-m-d', strtotime($date)));
															//$curdate = strtotime(date("d/m/Y"));
															$curdate = time();
															//echo "$Visa_date - $curdate";
															//if(!empty($Visa_date) && (strtotime(date("d/m/Y",$Visa_date)) > strtotime(date("d/m/Y")))) {
															if(!empty($Passport_date) && ( $Passport_date < $curdate)) {
																$Expirydate2 = 1;
																//echo '<script> alert($wphrmEmployeeSettingsOther.": EXPIRED!")</script>'; 
																//echo " Todat is: ".date("d/m/Y")." and the VISA Expiry date is: ".date("d/m/Y",$Visa_date);
																//echo "Result: ".(strtotime(date("d/m/Y",$Visa_date)) < strtotime(date("d/m/Y")));
																?>
															
															<i style="color:red;" class="fa fa-id-card icon">EXPIRED!</i> 
															
															
															<?php 
															
															}
															} ?>
															<?php 
															
															if ($wphrmEmployeeSettingsOther == 'LC Expiry date'){
															$date = str_replace('/', '-', $wphrmOtherSettingsvalue);
															$LC_date = strtotime(date('Y-m-d', strtotime($date)));
															//$curdate = strtotime(date("d/m/Y"));
															$curdate = time();
															//echo "$Visa_date - $curdate";
															//if(!empty($Visa_date) && (strtotime(date("d/m/Y",$Visa_date)) > strtotime(date("d/m/Y")))) {
															if(!empty($LC_date) && ( $LC_date < $curdate)) {
																$Expirydate3 = 1;
																//echo '<script> alert($wphrmEmployeeSettingsOther.": EXPIRED!")</script>'; 
																//echo " Todat is: ".date("d/m/Y")." and the VISA Expiry date is: ".date("d/m/Y",$Visa_date);
																//echo "Result: ".(strtotime(date("d/m/Y",$Visa_date)) < strtotime(date("d/m/Y")));
																?>
															
															<i style="color:red;" class="fa fa-id-card icon">EXPIRED!</i> 
															
															
															<?php 
															
															}
															} ?>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control" name="other-fields-value[]" type="text" value="<?php
                                                                if (isset($wphrmOtherSettingsvalue)) : echo esc_attr($wphrmOtherSettingsvalue);
                                                                endif;
                                                                ?>" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
													<?php 
														
                                                    }
                                                }
                                            }
											//send Alert email to admin 29-12-2020
											// echo "Still out".$Expirydate1.' - '.$Expirydate2.' - '.$Expirydate3;
											if ($Expirydate1 !== 0 || $Expirydate2 !== 0 || $Expirydate3 !== 0){
														   // echo "I'm IN".$Expirydate1.' - '.$Expirydate2.' - '.$Expirydate3;
															//testing email - delete after test 
															$to_email = 'itmanager@konfirm.co';
															$subject = 'Document Expiry date';
															$message = 'Please check document expiry date for user '.$wphrmEmployeeFirstName.' '.$wphrmEmployeeLastName;
															$headers = 'From: info@yearex.com';
															mail($to_email,$subject,$message,$headers);
															$Expirydate = ''; //rest flag
														}
											//-----------------------
											
                                            $wphrmOtherFieldsInfo = $this->parentWPHRM->WPHRMGetSettings('Otherfieldskey');
                                            if (!empty($wphrmOtherFieldsInfo) && $wphrmOtherFieldsInfo ='') {
                                                foreach ($wphrmOtherFieldsInfo['Otherfieldslebal'] as $wphrmOtherFieldsSettings) {
                                                    if (!in_array($wphrmOtherFieldsSettings, $wphrmEmployeeOtherInfo['wphrmotherfieldslebal'])) {
                                                        ?>
														
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmOtherFieldsSettings, $this->textDomain); ?></label>
                                                            <input disabled name="other-fields-lebal[]" type="hidden"  value="<?php
                                                            if (isset($wphrmOtherFieldsSettings)) : echo esc_attr($wphrmOtherFieldsSettings);
                                                            endif;
                                                            ?>"/>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control" name="other-fields-value[]" type="text" value="" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
														
                                                        <?php
                                                    }
                                                }
                                            }
                                        }else {
                                            $wphrmOtherfieldskeyInfo = $this->parentWPHRM->WPHRMGetSettings('Otherfieldskey');
                                            if (!empty($wphrmOtherfieldskeyInfo) && $wphrmOtherFieldsInfo ='') {
                                                foreach ($wphrmOtherfieldskeyInfo['Otherfieldslebal'] as $wphrmOthersettingInfo) {
                                                    ?>
													
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><?php _e($wphrmOthersettingInfo, $this->textDomain); ?></label>
                                                        <input disabled name="other-fields-lebal[]" type="hidden"  value="<?php
                                                        if (isset($wphrmOthersettingInfo)) : echo esc_attr($wphrmOthersettingInfo);
                                                        endif;
                                                        ?>"/>
                                                        <div class="col-md-8">
                                                            <input disabled class="form-control" name="other-fields-value[]" type="text" value="" autocapitalize="none"  />
                                                        </div>
                                                    </div> 
													
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php
                                    }else {
                                        if (isset($wphrmEmployeeOtherInfo['wphrmotherfieldslebal']) && $wphrmEmployeeOtherInfo['wphrmotherfieldslebal'] != '' && isset($wphrmEmployeeOtherInfo['wphrmotherfieldsvalue']) && $wphrmEmployeeOtherInfo['wphrmotherfieldsvalue'] != '') {
                                            foreach ($wphrmEmployeeOtherInfo['wphrmotherfieldslebal'] as $lebalkey => $wphrmEmployeeSettingsOther) {
                                                foreach ($wphrmEmployeeOtherInfo['wphrmotherfieldsvalue'] as $valuekey => $wphrmOtherSettingsvalue) {
                                                    if ($lebalkey == $valuekey) {
                                                        ?>
														
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmEmployeeSettingsOther, $this->textDomain); ?></label>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control"  type="text"  value="<?php
                                                                if (isset($wphrmOtherSettingsvalue)) : echo esc_attr($wphrmOtherSettingsvalue);
                                                                endif; ?>" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
													
                                                        <?php
                                                    }
                                                }
                                            }
                                            $wphrmOtherFieldsInfo = $this->parentWPHRM->WPHRMGetSettings('Otherfieldskey');
                                            if (!empty($wphrmOtherFieldsInfo) && $wphrmOtherFieldsInfo ='') {
                                                foreach ($wphrmOtherFieldsInfo['Otherfieldslebal'] as $wphrmOtherFieldsSettings) {
                                                    if (!in_array($wphrmOtherFieldsSettings, $wphrmEmployeeOtherInfo['wphrmotherfieldslebal'])) { ?>
														

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmOtherFieldsSettings, $this->textDomain); ?></label>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control"  type="text" value="" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
												
                                                        <?php
                                                    }
                                                }
                                            }
                                        } else {
                                            $wphrmOtherfieldskeyInfo = $this->parentWPHRM->WPHRMGetSettings('Otherfieldskey');
                                            if (!empty($wphrmOtherfieldskeyInfo) && $wphrmOtherFieldsInfo ='') {
                                                foreach ($wphrmOtherfieldskeyInfo['Otherfieldslebal'] as $wphrmOthersettingInfo) {
                                                    ?>
													 

                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><?php _e($wphrmOthersettingInfo, $this->textDomain); ?></label>
                                                        <div class="col-md-8">
                                                            <input disabled class="form-control"  type="text" id="other-fields-value" value="" autocapitalize="none"  />
                                                        </div>
                                                    </div> 
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    <?php if (isset($wphrmEmployeeOtherInfo['wphrm_employee_vehicle']) && $wphrmEmployeeOtherInfo['wphrm_employee_vehicle'] != '') : ?>
                                    <div class="form-group">                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="wphrm_vehicle_type" class="col-md-4 control-label"><?php _e('Vehicle Type', $this->textDomain); ?>:</label>
                                                <div class="col-md-8">
                                                    <input disabled class="form-control" type="text" name="wphrm_vehicle_type" id="wphrm_vehicle_type" value="<?php
                                                    if (isset($wphrmEmployeeOtherInfo['wphrm_vehicle_type'])) : echo esc_attr($wphrmEmployeeOtherInfo['wphrm_vehicle_type']); endif; ?>"/>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="wphrm_employee_vehicle_model" class="col-md-4 control-label"><?php _e('Make-Model', $this->textDomain); ?>:</label>
                                                <div class="col-md-8">
                                                    <input disabled class="form-control" type="text" name="wphrm_employee_vehicle_model" id="wphrm_employee_vehicle_model" value="<?php
                                                    if (isset($wphrmEmployeeOtherInfo['wphrm_employee_vehicle_model'])) : echo esc_attr($wphrmEmployeeOtherInfo['wphrm_employee_vehicle_model']); endif; ?>"/>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-bottom:0px;">
                                                <label for="wphrm_employee_vehicle_registrationno" class="col-md-4 control-label"><?php _e('Registration No.', $this->textDomain); ?>:</label>
                                                <div class="col-md-8">
                                                    <input disabled class="form-control" type="text" name="wphrm_employee_vehicle_registrationno" id="wphrm_employee_vehicle_registrationno" value="<?php
                                                    if (isset($wphrmEmployeeOtherInfo['wphrm_employee_vehicle_registrationno'])) : echo esc_attr($wphrmEmployeeOtherInfo['wphrm_employee_vehicle_registrationno']); endif; ?>"/>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <?php endif; ?>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label"><?php _e('T-Shirt Size', $this->textDomain); ?></label>
                                        <div class="col-md-8">
                                            <?php $wphrmTShirtSizes = array('xxxs'=>'XXXS', 'xxs'=>'XXS', 'xs'=>'XS', 's'=>'S', 'm'=>'M', 'l'=>'L', 'xl'=>'XL', 'xxl'=>'XXL', 'xxxl'=>'XXXL'); ?>
                                            <input disabled class="form-control" type="text" name="wphrm_employee_vehicle_model" id="wphrm_employee_vehicle_model" value="<?php
                                           if (isset($wphrmEmployeeOtherInfo['wphrm_t_shirt_size']) && $wphrmEmployeeOtherInfo['wphrm_t_shirt_size']!='') : echo esc_attr($wphrmTShirtSizes[$wphrmEmployeeOtherInfo['wphrm_t_shirt_size']]);
                                           endif; ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                 
                    <div class="portlet box red-sunglo  salary-details-div">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-money"></i><?php _e('Salary Details', $this->textDomain); ?>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="alert alert-success display-hide" id="salary_details_success">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <div class="alert alert-danger display-hide" id="salary_details_success_error">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <form method="POST"  accept-charset="UTF-8" class="form-horizontal" id="wphrmEmployeeSalaryInfo_form">   
                                
                                <div id="alert_bank"></div>
                                <div class="form-body">
                                     <div class="form-group">
                                            <label class="col-md-4 control-label"><?php _e('Current Salary', $this->textDomain); ?></label>
                                            <div class="col-md-8">
                                                <input class="form-control" disabled type="text" id="current-salary" value="<?php
                                                if (isset($wphrmEmployeeSalaryInfo['current-salary'])) : echo esc_attr($wphrmEmployeeSalaryInfo['current-salary']);
                                                endif;
                                                ?>" autocapitalize="none"  />
                                            </div>
                                        </div> 
                                    <?php
                                        if (isset($wphrmEmployeeSalaryInfo['SalaryFieldsLebal']) && $wphrmEmployeeSalaryInfo['SalaryFieldsLebal'] != '' && isset($wphrmEmployeeSalaryInfo['SalaryFieldsvalue']) && $wphrmEmployeeSalaryInfo['SalaryFieldsvalue'] != '') {
                                            foreach ($wphrmEmployeeSalaryInfo['SalaryFieldsLebal'] as $lebalkey => $wphrmEmployeeSettingsSalary) {
                                                foreach ($wphrmEmployeeSalaryInfo['SalaryFieldsvalue'] as $valuekey => $wphrmSalarySettingsvalue) {
                                                    if ($lebalkey == $valuekey) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmEmployeeSettingsSalary, $this->textDomain); ?></label>
                                                            <input disabled name="salary-fields-lebal[]" type="hidden" value="<?php
                                                            if (isset($wphrmEmployeeSettingsSalary)) : echo esc_attr($wphrmEmployeeSettingsSalary); endif; ?>"/>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control" name="salary-fields-value[]" type="text" value="<?php
                                                                if (isset($wphrmSalarySettingsvalue)) : echo esc_attr($wphrmSalarySettingsvalue); endif; ?>" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                        <?php
                                                    }
                                                }
                                            }
                                            $wphrmSalaryFieldsInfo = $this->parentWPHRM->WPHRMGetSettings('salarydetailfieldskey');
                                            if (!empty($wphrmSalaryFieldsInfo)) {
                                                foreach ($wphrmSalaryFieldsInfo['salarydetailfieldlabel'] as $wphrmSalaryFieldsSettings) {
                                                    if (!in_array($wphrmSalaryFieldsSettings, $wphrmEmployeeSalaryInfo['SalaryFieldsLebal'])) {
                                                        ?>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label"><?php _e($wphrmSalaryFieldsSettings, $this->textDomain); ?></label>
                                                            <input disabled name="salary-fields-lebal[]" type="hidden" value="<?php
                                                            if (isset($wphrmSalaryFieldsSettings)) : echo esc_attr($wphrmSalaryFieldsSettings); endif; ?>"/>
                                                            <div class="col-md-8">
                                                                <input disabled class="form-control" name="salary-fields-value[]" type="text"  value="" autocapitalize="none"  />
                                                            </div>
                                                        </div> 
                                                        <?php
                                                    }
                                                }
                                            }
                                        } else {
                                            $wphrmSalaryfieldskeyInfo = $this->parentWPHRM->WPHRMGetSettings('salarydetailfieldskey');
                                            if (!empty($wphrmSalaryfieldskeyInfo)) {
                                                foreach ($wphrmSalaryfieldskeyInfo['salarydetailfieldlabel'] as $wphrmSalarysettingInfo) {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><?php _e($wphrmSalarysettingInfo, $this->textDomain); ?></label>
                                                        <input disabled name="salary-fields-lebal[]" type="hidden"  value="<?php
                                                        if (isset($wphrmSalarysettingInfo)) : echo esc_attr($wphrmSalarysettingInfo); endif; ?>"/>
                                                        <div class="col-md-8">
                                                            <input disabled class="form-control" name="salary-fields-value[]" type="text" id="salary-fields-value" value="" autocapitalize="none"  />
                                                        </div>
                                                    </div> 
                                                    <?php
                                                }
                                            }
                                        } ?>                                  
                                </div>
                            </form>
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