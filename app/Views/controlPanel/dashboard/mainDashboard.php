<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <div id="kt_app_toolbar_container" class="app-container container-xxl ">
        <div class="page-title justify-content-center me-3">
            <!--Title-->
            <h1 class="page-heading text-dark fw-bold fs-3 justify-content-center my-0"><?php echo lang('Text.top_bar_dashboard'); ?></h1>
        </div>
        <!-- FORM 1 -->
        <div class="card-body mt-6">
            <div class="row">
                <div class="col-12 col-lg-2 mt-5">
                    <img class="w-75" src="<?php echo base_url('public/assets/media/img/uscis.png') ?>" alt="Image">
                </div>
                <div class="col-12 col-lg-8 text-center mt-5">
                    <h1><?php echo lang('Text.form1_title'); ?></h1>
                    <h5 class="mt-5"><?php echo lang('Text.form1_subtitle1'); ?></h5>
                    <p><?php echo lang('Text.form1_subtitle2'); ?></p>
                </div>
                <div class="col-12 col-lg-2 text-center">
                    <p class="fw-bold fs-4"><?php echo lang('Text.USCIS'); ?></p>
                    <p class="fw-bold fs-4"><?php echo lang('Text.form_i9'); ?></p>
                    <p>OMB No. 1615-0047</p>
                    <p><?php echo lang('Text.form_expires'); ?></p>
                </div>
            </div>
            <hr>
            <div class="mt-5">
                <p class="fw-bold"><?php echo lang('Text.form1_start_here'); ?></p>
                <p><span class="fw-bold"><?php echo lang('Text.form1_adn_title'); ?></span><?php echo lang('Text.form1_adn_msg'); ?></p>
                <div class="border border-4">
                    <p class="bg-gray-200 p-2"><span class="fw-bold"><?php echo lang('Text.form1_section1_title'); ?></span><?php echo lang('Text.form1_section1_msg'); ?></p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-3 ">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.last_name_family_name'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.first_name_given_name'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.middle_initial'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.other_names_used_if_any'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.address_street_name'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-2">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.apt_number'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm number mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.city_or_town'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-1">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.state'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-2">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.zip'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm number zip-mask mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.date_of_birth'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.ssn'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm ssn-mask number mb-3 mb-lg-0 required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.emp_email_address'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0 email required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6"><?php echo lang('Text.emp_phone_number'); ?></label>
                            <input type="text" id="txt-" class="form-control form-control-sm phone-mask mb-3 mb-lg-0 required">
                        </div>
                        <div class="mt-6 row ms-1" style="border-top: 1px solid gray;">
                            <div class="col-12 col-lg-3 ">
                                <p class="m-2"><strong><?php echo lang('Text.form1_text1'); ?></strong></p>
                            </div>
                            <div class="col-12 col-lg-9 mt-2 row">
                                <p><?php echo lang('Text.form1_text2'); ?></p>
                                <div class="col-12 mt-2">
                                    <input type="checkbox" id="cb-1" class="cbx"> <label for="cb-1"><?php echo lang('Text.form1_cbx1'); ?> </label>
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="checkbox" id="cb-2" class="cbx"> <label for="cb-2"><?php echo lang('Text.form1_cbx2'); ?> </label>
                                </div>
                                <div class="col-12 row">
                                    <div class="col-6 mt-2">
                                        <input type="checkbox" id="cb-3" class="cbx"> <label for="cb-3"><?php echo lang('Text.form1_cbx3'); ?> </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="text" id="txt-" class="form-control form-control-sm ">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="checkbox" id="cb-4" class="cbx"><label for="cb-4"><?php echo lang('Text.form1_cbx4'); ?> </label>
                                </div>
                                <div class="mt-6">
                                    <p><?php echo lang('Text.form1_if_check4');?></p>
                                    <div class="row">
                                        <div class="col-2 text-lg-center">
                                            <p><strong><?php echo lang('Text.uscis_anumber');?></strong></p>
                                            <input type="text" class="form-control form-control-sm ">
                                        </div>
                                        <div class="col-1 mt-5 text-center"><?php echo lang('Text.or');?></div>
                                        <div class="col-3">
                                            <p><strong><?php echo lang('Text.admission_number');?></strong></p>
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                        <div class="col-1 mt-5 text-center"><?php echo lang('Text.or');?></div>
                                        <div class="col-5">
                                            <p><strong><?php echo lang('Text.passport_number');?></strong></p>
                                            <input type="text" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 row" style="border-top: 1px solid gray;">
                                <div class="col-8 mt-4">
                                    <p><?php echo lang('Text.employee_sign');?></p>
                                    <input type="text" id="txt-" class="form-control form-control-sm">
                                </div>
                                <div class="col-4 mt-4">
                                    <p><?php echo lang('Text.today_date');?></p>
                                    <input type="text" class="form-control form-control-sm " value="<?php echo date('d/m/Y')?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6" style="border-top: 6px solid gray;"> </div>
                    <p class="bg-gray-200 p-2"><span class="fw-bold">Section 2. Employer Review and Verification: Employnt, aners d mor their authorized representative must complete anust physically examine, or examine consistent with an alternative procedure d sign Section 2 within three business days after the employee's first day of employme
                            authorized by the Secretary of DHS, documentation from List A OR a combination of documentation from List B and List C. Enter any additional documentation in the Additional Information box; see Instructions.
                    </p>
                    <div class="row">
                        <div class="text-center col-6">
                            <p class="fw-bold">List A</p>
                            <div class="row">
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2 fw-bold">Document Title 1</p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Issuing Authority </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Document Number (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Expiration Date (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2 fw-bold">Document Title 2 (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Issuing Authority </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Document Number (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Expiration Date (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2 fw-bold">Document Title 3 (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Issuing Authority </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Document Number (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                                <div class="col-6">
                                    <p class="bg-gray-200 p-2">Expiration Date (if any) </p>
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control form-control-sm ">
                                </div>
                            </div>
                        </div>
                        <div class="text-center col-6 row">
                            <div class="col-1 bg-gray-200 p-2">
                                <p class="fw-bold "><?php echo lang('Text.or');?></p>
                            </div>
                            <div class="col-5 h-75px">
                                <p class="fw-bold">List B </p>
                                <input type="text" class="form-control form-control-sm ">
                                <input type="text" class="form-control form-control-sm mt-3">
                                <input type="text" class="form-control form-control-sm mt-3">
                                <input type="text" class="form-control form-control-sm mt-3">
                            </div>
                            <div class="col-1 h-75px">
                                <p class="fw-bold">AND</p>
                            </div>
                            <div class="col-5 h-75px">
                                <p class="fw-bold">List C</p>
                                <input type="text" class="form-control form-control-sm ">
                                <input type="text" class="form-control form-control-sm mt-3">
                                <input type="text" class="form-control form-control-sm mt-3">
                                <input type="text" class="form-control form-control-sm mt-3">
                            </div>
                            <p class="fw-bold bg-gray-200 p-2 h-30px">Additional Information </p>
                            <p>Check here if you used an alternative procedure authorized by DHS to examine documents. </p>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-9">
                            <p class="fw-bold">Certification: I attest, under penalty of perjury, that (1) I have examined the documentation presented by the above-named employee, (2) the above-listed documentation appears to be genuine and to relate to the employee named, and (3) to the best of my knowledge, the employee is authorized to work in the United States. </p>
                        </div>
                        <div class="col-3">
                            <label for="">First Day of Employment (mm/dd/yyyy): </label>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                        <div class="col-5">
                            <p>Last Name, First Name and Title of Employer or Authorized Representative </p>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                        <div class="col-5">
                            <p>Signature of Employer or Authorized Representative </p>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                        <div class="col-2">
                            <p>Today's Date (mm/dd/yyyy)</p>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                        <div class="col-3 mt-4">
                            <p>Employer's Business or Organization Name </p>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                        <div class="col-9 mt-4">
                            <p>Employer's Business or Organization Address, City or Town, State, ZIP Code </p>
                            <input type="text" class="form-control form-control-sm ">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 mb-20">
            <hr>
            <h1 class="text-center">FORM 2</h1>
            <hr>
        </div>
        <!-- FORM 2 -->
        <div class="card-body mt-6 ">
            <div class="text-center">
                <h1>LISTS OF ACCEPTABLE DOCUMENTS </h1>
                <p>All documents containing an expiration date must be unexpired.
                    * Documents extended by the issuing authority are considered unexpired.
                    Employees may present one selection from List A or a combination of one selection from List B and one selection from List C.
                </p>
                <h4>Examples of many of these documents appear in the Handbook for Employers (M-274). </h4>
            </div>
            <div class="row mt-10 border border-4 p-2">
                <div class="col-4 text-center">
                    <h6>LIST A </h6>
                    <p>Documents that Establish Both Identity and Employment Authorization </p>
                    <hr>
                    <div class="text-start">
                        <p><span class="fw-bold">1. </span> U.S. Passport or U.S. Passport Card</p>
                        <p><span class="fw-bold">2. </span> Permanent Resident Card or Alien Registration Receipt Card (Form I-551)</p>
                        <p><span class="fw-bold">3. </span> Foreign passport that contains a temporary I-551 stamp or temporary I-551 printed notation on a machinereadable immigrant visa</p>
                        <p><span class="fw-bold">4. </span> Employment Authorization Document that contains a photograph (Form I-766)</p>
                        <p><span class="fw-bold">5. </span> For an individual temporarily authorized to work for a specific employer because of his or her status or parole:</p>
                        <p class="ms-5"><span class="fw-bold">a. </span> Foreign passport; and</p>
                        <p class="ms-5"><span class="fw-bold">b. </span> Form I-94 or Form I-94A that has the following:</p>
                        <p class="ms-10"><span class="fw-bold">(1) </span> The same name as the passport; and</p>
                        <p class="ms-10"><span class="fw-bold">(2) </span>An endorsement of the individual's status or parole as long as that period of endorsement has not yet expired and the proposed employment is not in conflict with any restrictions or limitations identified on the form.</p>
                        <p><span class="fw-bold">6. </span> Passport from the Federated States of Micronesia (FSM) or the Republic of the Marshall Islands (RMI) with Form I-94 or Form I-94A indicating nonimmigrant admission under the Compact of Free Association Between the United States and the FSM or RMI</p>
                    </div>
                </div>
                <div class="col-1 text-center">
                    <h6 class="mb-9 mt-9"><?php echo lang('Text.or');?></h6>
                    <hr>
                </div>
                <div class="col-7 text-center">
                    <div class="row">
                        <div class="col-6">
                            <h6>LIST B </h6>
                            <p class="mb-10">Documents that Establish Identity </p>
                            <hr>
                            <div class="text-start">
                                <p><span class="fw-bold">1. </span>Driver's license or ID card issued by a State or outlying possession of the United States provided it contains a photograph or information such as name, date of birth, gender, height, eye color, and address</p>
                                <p><span class="fw-bold">2. </span>ID card issued by federal, state or local government agencies or entities, provided it contains a photograph or information such as name, date of birth, gender, height, eye color, and address</p>
                                <p><span class="fw-bold">3. </span>School ID card with a photograph</p>
                                <p><span class="fw-bold">4. </span>Voter's registration card</p>
                                <p><span class="fw-bold">5. </span>U.S. Military card or draft record</p>
                                <p><span class="fw-bold">6. </span>Military dependent's ID card</p>
                                <p><span class="fw-bold">7. </span>U.S. Coast Guard Merchant Mariner Card</p>
                                <p><span class="fw-bold">8. </span>Native American tribal document</p>
                                <p><span class="fw-bold">9. </span>Driver's license issued by a Canadian government authority</p>
                                <h4 class="text-center">For persons under age 18 who are unable to present a document listed above: </h4>
                                <p><span class="fw-bold">10. </span>School record or report card</p>
                                <p><span class="fw-bold">11. </span>Clinic, doctor, or hospital record</p>
                                <p><span class="fw-bold">12. </span>Day-care or nursery school record</p>
                            </div>
                        </div>
                        <div class="col-1">
                            <h6 class="mt-9 mb-9">AND</h6>
                            <hr>
                        </div>
                        <div class="col-5">
                            <h6>LIST C</h6>
                            <p>Documents that Establish Employment Authorization</p>
                            <hr>
                            <div class="text-start">
                                <p><span class="fw-bold">1. </span>A Social Security Account Number card, unless the card includes one of the following restrictions:</p>
                                <p class="ms-5"><span class="fw-bold">(1) </span>NOT VALID FOR EMPLOYMENT</p>
                                <p class="ms-5"><span class="fw-bold">(2) </span>VALID FOR WORK ONLY WITH INS AUTHORIZATION</p>
                                <p class="ms-5"><span class="fw-bold">(3) </span>VALID FOR WORK ONLY WITH DHS AUTHORIZATION</p>
                                <p><span class="fw-bold">2. </span>Certification of report of birth issued by the Department of State (Forms DS-1350,FS-545, FS-240)</p>
                                <p><span class="fw-bold">3. </span>Original or certified copy of birth certificate issued by a State, county, municipal authority, or territory of the United States bearing an official seal</p>
                                <p><span class="fw-bold">4. </span>Native American tribal document</p>
                                <p><span class="fw-bold">5. </span>U.S. Citizen ID Card (Form I-197)</p>
                                <p><span class="fw-bold">6. </span>Identification Card for Use of Resident Citizen in the United States (Form I-179)</p>
                                <p><span class="fw-bold">7. </span>Employment authorization document issued by the Department of Homeland Security</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2 mt-2" style="border-top: 6px solid gray;"></div>
                <div class="text-center">
                    <h1>Acceptable Receipts </h1>
                    <p>May be presented in lieu of a document listed above for a temporary period.</p>
                    <p>For receipt validity dates, see the M-274. </p>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4 text-start">
                        <p>● Receipt for a replacement of a lost, stolen, or damaged List A document.</p>
                        <p>● Form I-94 issued to a lawful permanent resident that contains</p>
                        <p class="ms-5">an I-551 stamp and a photograph of the individual.</p>
                        <p>● Form I-94 with “RE” notation or refugee stamp issued to a refugee.</p>
                    </div>
                    <div class="col-1 text-center">
                        <h6><?php echo lang('Text.or');?></h6>
                    </div>
                    <div class="col-7 text-start">
                        <div class="row">
                            <div class="col-6">
                                <p>Receipt for a replacement of a lost, stolen, or damaged List B document. </p>
                            </div>
                            <div class="col-6">
                                <p>Receipt for a replacement of a lost, stolen, or damaged List C document. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="mt-20 mb-20">
            <hr>
            <h1 class="text-center">FORM 3</h1>
            <hr>
        </div>
        <!-- FORM 3 -->
        <div class="card-body mt-6">
            <div class="row">
                <div class="col-12 col-lg-2 mt-5">
                    <img class="w-75" src="<?php echo base_url('public/assets/media/img/uscis.png') ?>" alt="Image">
                </div>
                <div class="col-12 col-lg-8 text-center mt-5">
                    <h1>Supplement A, </h1>
                    <h1>Preparer and/or Translator Certification for Section 1 </h1>
                    <h5 class="mt-5">Department of Homeland Security </h5>
                    <p>U.S. Citizenship and Immigration Services</p>
                </div>
                <div class="col-12 col-lg-2 text-center">
                    <p class="fw-bold fs-4">USCIS</p>
                    <p class="fw-bold fs-4">Form I-9</p>
                    <p class="fw-bold fs-4">Supplement A</p>
                    <p>OMB No. 1615-0047</p>
                    <p>Expires 07/31/2026</p>
                </div>
            </div>
            <hr>
            <div class="mt-2">
                <div class="row p-2">
                    <div class="col-12 col-lg-6 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name) from Section 1</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name) from Section 1. </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="col-form-label fw-semibold fs-6">Middle initial (if any) from Section 1. </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                </div>
                <p><span class="fw-bold">Instructions: </span> This supplement must be completed by any preparer and/or translator who assists an employee in completing Section 1 of Form I-9. The preparer and/or translator must enter the employee's name in the spaces provided above. Each preparer or translator must complete, sign, and date a separate certification area. Employers must retain completed supplement sheets with the employee's completed Form I-9. </p>
                <h6 class="text-center mt-4">I attest, under penalty of perjury, that I have assisted in the completion of Section 1 of this form and that to the best of my knowledge the information is true and correct. </h6>
                <div class="row p-2">
                    <div class="col-12 col-lg-8 ">
                        <label class="col-form-label fw-semibold fs-6">Signature of Preparer or Translator </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">Middle Initial (if any) </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">Address <span class="fst-italic">(Street Number and Name)</span></label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">City or Town</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">State</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required" max>
                    </div>
                    <div class="col-12 col-lg-1">
                        <label class="col-form-label fw-semibold fs-6">Zip Code</label>
                        <input type="text" id="txt-" class="form-control form-control-sm number mb-3 mb-lg-0  required" maxlength="5">
                    </div>
                </div>
                <h6 class="text-center mt-4">I attest, under penalty of perjury, that I have assisted in the completion of Section 1 of this form and that to the best of my knowledge the information is true and correct. </h6>
                <div class="row p-2">
                    <div class="col-12 col-lg-8 ">
                        <label class="col-form-label fw-semibold fs-6">Signature of Preparer or Translator </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">Middle Initial (if any) </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">Address <span class="fst-italic">(Street Number and Name)</span></label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">City or Town</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">State</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required" max>
                    </div>
                    <div class="col-12 col-lg-1">
                        <label class="col-form-label fw-semibold fs-6">Zip Code</label>
                        <input type="text" id="txt-" class="form-control form-control-sm number mb-3 mb-lg-0  required" maxlength="5">
                    </div>
                </div>
                <h6 class="text-center mt-4">I attest, under penalty of perjury, that I have assisted in the completion of Section 1 of this form and that to the best of my knowledge the information is true and correct. </h6>
                <div class="row p-2">
                    <div class="col-12 col-lg-8 ">
                        <label class="col-form-label fw-semibold fs-6">Signature of Preparer or Translator </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">Middle Initial (if any) </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">Address <span class="fst-italic">(Street Number and Name)</span></label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">City or Town</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">State</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required" max>
                    </div>
                    <div class="col-12 col-lg-1">
                        <label class="col-form-label fw-semibold fs-6">Zip Code</label>
                        <input type="text" id="txt-" class="form-control form-control-sm number mb-3 mb-lg-0  required" maxlength="5">
                    </div>
                </div>
                <h6 class="text-center mt-4">I attest, under penalty of perjury, that I have assisted in the completion of Section 1 of this form and that to the best of my knowledge the information is true and correct. </h6>
                <div class="row p-2">
                    <div class="col-12 col-lg-8 ">
                        <label class="col-form-label fw-semibold fs-6">Signature of Preparer or Translator </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name)</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">Middle Initial (if any) </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                    <div class="col-12 col-lg-5">
                        <label class="col-form-label fw-semibold fs-6">Address <span class="fst-italic">(Street Number and Name)</span></label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-4">
                        <label class="col-form-label fw-semibold fs-6">City or Town</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-2">
                        <label class="col-form-label fw-semibold fs-6">State</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required" max>
                    </div>
                    <div class="col-12 col-lg-1">
                        <label class="col-form-label fw-semibold fs-6">Zip Code</label>
                        <input type="text" id="txt-" class="form-control form-control-sm number mb-3 mb-lg-0  required" maxlength="5">
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-20 mb-20">
            <hr>
            <h1 class="text-center">FORM 4</h1>
            <hr>
        </div>
        <!-- FORM 4 -->
        <div class="card-body mt-6">
            <div class="row">
                <div class="col-12 col-lg-2 mt-5">
                    <img class="w-75" src="<?php echo base_url('public/assets/media/img/uscis.png') ?>" alt="Image">
                </div>
                <div class="col-12 col-lg-8 text-center mt-5">
                    <h1>Supplement B, </h1>
                    <h1>Reverification and Rehire (formerly Section 3) </h1>
                    <h5 class="mt-5">Department of Homeland Security </h5>
                    <p>U.S. Citizenship and Immigration Services</p>
                </div>
                <div class="col-12 col-lg-2 text-center">
                    <p class="fw-bold fs-4">USCIS</p>
                    <p class="fw-bold fs-4">Form I-9</p>
                    <p class="fw-bold fs-4">Supplement B</p>
                    <p>OMB No. 1615-0047</p>
                    <p>Expires 07/31/2026</p>
                </div>
            </div>
            <hr>
            <div class="mt-2">
                <div class="row">
                    <div class="col-12 col-lg-6 ">
                        <label class="col-form-label fw-semibold fs-6">Last Name (Family Name) from Section 1</label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="col-form-label fw-semibold fs-6">First Name (Given Name) from Section 1. </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                    </div>
                    <div class="col-12 col-lg-3">
                        <label class="col-form-label fw-semibold fs-6">Middle initial (if any) from Section 1. </label>
                        <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  ">
                    </div>
                </div>
                <p class="fw-bold">Instructions: This supplement replaces Section 3 on the previous version of Form I-9. Only use this page if your employee requires reverification, is rehired within three years of the date the original Form I-9 was completed, or provides proof of a legal name change. Enter the employee's name in the fields above. Use a new section for each reverification or rehire. Review the Form I-9 instructions before completing this page. Keep this page as part of the employee's Form I-9 record. Additional guidance can be found in the Handbook for Employers: Guidance for Completing Form I-9 (M-274) </p>
                <div class="border border-3 p-2">
                    <div class="row">
                        <div class="col-4">
                            <p class="bg-gray-200 p-2">Date of Rehire (if applicable) </p>
                            <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-8">
                            <p class="bg-gray-200 p-2">New Name (if applicable)</p>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label fw-semibold fs-6">Last Name (Family Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-semibold fs-6">First Name (Given Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-semibold fs-6">Middle Initial </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="bg-gray-200 p-2 mt-4">Reverification: If the employee requires reverification, your employee can choose to present any acceptable List A or List C documentation to show continued employment authorization. Enter the document information in the spaces below. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Document Title </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Document Number (if any)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Expiration Date (if any) (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                    </div>
                    <p class="fw-bold bg-gray-200 p-2 mt-4">I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if the employee presented documentation, the documentation I examined appears to be genuine and to relate to the individual who presented it. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Name of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Signature of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Today's Date (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                        <div class="col-9 mt-4">
                            <p>Additional Information (Initial and date each notation.) </p>
                        </div>
                        <div class="col-3 mt-4">
                            <p>Check here if you used an alternative procedure authorized by DHS to examine documents.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="bg-gray-200 p-2">Date of Rehire (if applicable) </p>
                            <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-8">
                            <p class="bg-gray-200 p-2">New Name (if applicable)</p>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label fw-semibold fs-6">Last Name (Family Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-semibold fs-6">First Name (Given Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-semibold fs-6">Middle Initial </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="bg-gray-200 p-2 mt-4">Reverification: If the employee requires reverification, your employee can choose to present any acceptable List A or List C documentation to show continued employment authorization. Enter the document information in the spaces below. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Document Title </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Document Number (if any)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Expiration Date (if any) (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                    </div>
                    <p class="fw-bold bg-gray-200 p-2 mt-4">I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if the employee presented documentation, the documentation I examined appears to be genuine and to relate to the individual who presented it. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Name of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Signature of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Today's Date (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                        <div class="col-9 mt-4">
                            <p>Additional Information (Initial and date each notation.) </p>
                        </div>
                        <div class="col-3 mt-4">
                            <p>Check here if you used an alternative procedure authorized by DHS to examine documents.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <p class="bg-gray-200 p-2">Date of Rehire (if applicable) </p>
                            <label class="col-form-label fw-semibold fs-6">Date of Birth (mm/dd/yyyy)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-8">
                            <p class="bg-gray-200 p-2">New Name (if applicable)</p>
                            <div class="row">
                                <div class="col-6">
                                    <label class="col-form-label fw-semibold fs-6">Last Name (Family Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-4">
                                    <label class="col-form-label fw-semibold fs-6">First Name (Given Name) </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label fw-semibold fs-6">Middle Initial </label>
                                    <input type="text" id="txt-" class="form-control form-control-sm mb-3 mb-lg-0  required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="bg-gray-200 p-2 mt-4">Reverification: If the employee requires reverification, your employee can choose to present any acceptable List A or List C documentation to show continued employment authorization. Enter the document information in the spaces below. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Document Title </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Document Number (if any)</label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Expiration Date (if any) (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                    </div>
                    <p class="fw-bold bg-gray-200 p-2 mt-4">I attest, under penalty of perjury, that to the best of my knowledge, this employee is authorized to work in the United States, and if the employee presented documentation, the documentation I examined appears to be genuine and to relate to the individual who presented it. </p>
                    <div class="row p-2">
                        <div class="col-12 col-lg-5 ">
                            <label class="col-form-label fw-semibold fs-6">Name of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-4">
                            <label class="col-form-label fw-semibold fs-6">Signature of Employer or Authorized Representative </label>
                            <input type="text" id="txt-" class="form-control form-control-sm  mb-3 mb-lg-0  required">
                        </div>
                        <div class="col-12 col-lg-3">
                            <label class="col-form-label fw-semibold fs-6">Today's Date (mm/dd/yyyy) </label>
                            <input type="text" id="txt-" class="form-control form-control-sm datepicker mb-3 mb-lg-0  ">
                        </div>
                        <div class="col-9 mt-4">
                            <p>Additional Information (Initial and date each notation.) </p>
                        </div>
                        <div class="col-3 mt-4">
                            <p>Check here if you used an alternative procedure authorized by DHS to examine documents.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".datepicker").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY'));
        $(this).removeClass('is-invalid');
    }).on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

    Inputmask({
        "mask": "(999) 999-9999"
    }).mask(".phone-mask");
    Inputmask({
        "mask": "99999"
    }).mask(".zip-mask");
    Inputmask({
        "mask": "999-99-9999"
    }).mask(".ssn-mask");

    $('.cbx').on('click', function() {
        $('.cbx').each(function() {
            $(this).removeAttr('checked');
        });
        $(this).attr('checked', true);
    });
</script>