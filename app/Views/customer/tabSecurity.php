<div class="tab-pane fade" id="kt_user_view_overview_security" role="tabpanel">
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title">
                <h2>Profile</h2>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pt-0 pb-5">
            <!--begin::Table wrapper-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle table-row-dashed gy-5" id="kt_table_users_login_session">
                    <tbody class="fs-6 fw-semibold text-gray-600">
                        <tr>
                            <td>Email</td>
                            <td>smith@kpmg.com</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_email">
                                    <i class="ki-duotone ki-pencil fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>******</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_password">
                                    <i class="ki-duotone ki-pencil fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>Administrator</td>
                            <td class="text-end">
                                <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">
                                    <i class="ki-duotone ki-pencil fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table wrapper-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2 class="mb-1">Two Step Authentication</h2>
                <div class="fs-6 fw-semibold text-muted">Keep your account extra secure with a second authentication step.</div>
            </div>
            <!--end::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Add-->
                <button type="button" class="btn btn-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="ki-duotone ki-fingerprint-scanning fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>Add Authentication Step</button>
                <!--begin::Menu-->
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4" data-kt-menu="true">
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_auth_app">Use authenticator app</a>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">Enable one-time password</a>
                    </div>
                    <!--end::Menu item-->
                </div>
                <!--end::Menu-->
                <!--end::Add-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body pb-5">
            <!--begin::Item-->
            <div class="d-flex flex-stack">
                <!--begin::Content-->
                <div class="d-flex flex-column">
                    <span>SMS</span>
                    <span class="text-muted fs-6">+61 412 345 678</span>
                </div>
                <!--end::Content-->
                <!--begin::Action-->
                <div class="d-flex justify-content-end align-items-center">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5" data-bs-toggle="modal" data-bs-target="#kt_modal_add_one_time_password">
                        <i class="ki-duotone ki-pencil fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto" id="kt_users_delete_two_step">
                        <i class="ki-duotone ki-trash fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Action-->
            </div>
            <!--end::Item-->
            <!--begin:Separator-->
            <div class="separator separator-dashed my-5"></div>
            <!--end:Separator-->
            <!--begin::Disclaimer-->
            <div class="text-gray-600">If you lose your mobile device or security key, you can
                <a href="#" class="me-1">generate a backup code</a>to sign in to your account.
            </div>
            <!--end::Disclaimer-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    <!--begin::Card-->
    <div class="card pt-4 mb-6 mb-xl-9">
        <!--begin::Card header-->
        <div class="card-header border-0">
            <!--begin::Card title-->
            <div class="card-title flex-column">
                <h2>Email Notifications</h2>
                <div class="fs-6 fw-semibold text-muted">Choose what messages you’d like to receive for each of your accounts.</div>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Form-->
            <form class="form" id="kt_users_email_notification_form">
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_0" type="checkbox" value="0" id="kt_modal_update_email_notification_0" checked="checked">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_0">
                            <div class="fw-bold">Successful Payments</div>
                            <div class="text-gray-600">Receive a notification for every successful payment.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_1" type="checkbox" value="1" id="kt_modal_update_email_notification_1">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_1">
                            <div class="fw-bold">Payouts</div>
                            <div class="text-gray-600">Receive a notification for every initiated payout.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_2" type="checkbox" value="2" id="kt_modal_update_email_notification_2">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_2">
                            <div class="fw-bold">Application fees</div>
                            <div class="text-gray-600">Receive a notification each time you collect a fee from an account.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_3" type="checkbox" value="3" id="kt_modal_update_email_notification_3" checked="checked">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_3">
                            <div class="fw-bold">Disputes</div>
                            <div class="text-gray-600">Receive a notification if a payment is disputed by a customer and for dispute resolutions.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_4" type="checkbox" value="4" id="kt_modal_update_email_notification_4" checked="checked">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_4">
                            <div class="fw-bold">Payment reviews</div>
                            <div class="text-gray-600">Receive a notification if a payment is marked as an elevated risk.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_5" type="checkbox" value="5" id="kt_modal_update_email_notification_5">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_5">
                            <div class="fw-bold">Mentions</div>
                            <div class="text-gray-600">Receive a notification if a teammate mentions you in a note.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_6" type="checkbox" value="6" id="kt_modal_update_email_notification_6">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_6">
                            <div class="fw-bold">Invoice Mispayments</div>
                            <div class="text-gray-600">Receive a notification if a customer sends an incorrect amount to pay their invoice.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_7" type="checkbox" value="7" id="kt_modal_update_email_notification_7">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_7">
                            <div class="fw-bold">Webhooks</div>
                            <div class="text-gray-600">Receive notifications about consistently failing webhook endpoints.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <div class="separator separator-dashed my-5"></div>
                <!--begin::Item-->
                <div class="d-flex">
                    <!--begin::Checkbox-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="email_notification_8" type="checkbox" value="8" id="kt_modal_update_email_notification_8">
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_modal_update_email_notification_8">
                            <div class="fw-bold">Trial</div>
                            <div class="text-gray-600">Receive helpful tips when you try out our products.</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Checkbox-->
                </div>
                <!--end::Item-->
                <!--begin::Action buttons-->
                <div class="d-flex justify-content-end align-items-center mt-12">
                    <!--begin::Button-->
                    <button type="button" class="btn btn-light me-5" id="kt_users_email_notification_cancel">Cancel</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" class="btn btn-primary" id="kt_users_email_notification_submit">
                        <span class="indicator-label">Save</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--begin::Action buttons-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Card body-->
        <!--begin::Card footer-->
        <!--end::Card footer-->
    </div>
    <!--end::Card-->
</div>