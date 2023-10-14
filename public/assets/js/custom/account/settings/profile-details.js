"use strict";

var KTAccountSettingsProfileDetails = function () {
    var formElement, formValidator;

    return {
        init: function () {
            // Buscar el formulario por su ID
            formElement = document.getElementById("kt_account_profile_details_form");

            if (formElement) {
                // Elementos relevantes del formulario
                var submitButton = formElement.querySelector("#kt_account_profile_details_submit");

                // Inicializar el validador de formulario
                formValidator = FormValidation.formValidation(formElement, {
                    fields: {
                        fname: {
                            validators: {
                                notEmpty: {
                                    message: "El nombre es obligatorio"
                                }
                            }
                        },
                        lname: {
                            validators: {
                                notEmpty: {
                                    message: "El apellido es obligatorio"
                                }
                            }
                        },
                        company: {
                            validators: {
                                notEmpty: {
                                    message: "El nombre de la empresa es obligatorio"
                                }
                            }
                        },
                        phone: {
                            validators: {
                                notEmpty: {
                                    message: "El número de teléfono de contacto es obligatorio"
                                }
                            }
                        },
                        country: {
                            validators: {
                                notEmpty: {
                                    message: "Por favor, seleccione un país"
                                }
                            }
                        },
                        timezone: {
                            validators: {
                                notEmpty: {
                                    message: "Por favor, seleccione una zona horaria"
                                }
                            }
                        },
                        "communication[]": {
                            validators: {
                                notEmpty: {
                                    message: "Por favor, seleccione al menos un método de comunicación"
                                }
                            }
                        },
                        language: {
                            validators: {
                                notEmpty: {
                                    message: "Por favor, seleccione un idioma"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger,
                        submitButton: new FormValidation.plugins.SubmitButton,
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });

                // Escuchar cambios en los campos de selección
                $(formElement.querySelector('[name="country"]')).on("change", function () {
                    formValidator.revalidateField("country");
                });

                $(formElement.querySelector('[name="language"]')).on("change", function () {
                    formValidator.revalidateField("language");
                });

                $(formElement.querySelector('[name="timezone"]')).on("change", function () {
                    formValidator.revalidateField("timezone");
                });
            }
        }
    };
};

// Inicializar cuando se carga el DOM
KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsProfileDetails.init();
});
