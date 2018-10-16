 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw6cBSHs5woTFHP8qZvSIlBSYhH1BBOS4&libraries=places"></script>
<div class="main-content container-fluid">
    <div class="splash-container sign-up">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading"><img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img"><span class="splash-description">Please enter your user information.</span></div>
            <div class="panel-body">
                <form action="index.html" method="get"><span class="splash-title xs-pb-20">Sign Up</span>


                    <div class="form-group">
                        <input type="text"  placeholder="Nombre y apellido del contacto"   class="form-control register-form" id="register_user_name">
                    </div>

                    <div class="form-group">
                        <input type="email"  placeholder="Correo electrónico"   class="form-control register-form" id="register_user_email">
                    </div>

                    <div class="form-group">
                        <input type="tel"  placeholder="Teléfono"   class="form-control register-form" id="register_user_tel">
                    </div>

                    <div class="form-group">
                        <input type="text"  placeholder="Lugar de residencia"   class="form-control register-form" id="register_user_place">
                    </div>
                    <div class="form-group">
                        <input type="text"  placeholder="Nombre de la empresa"   class="form-control register-form" id="register_user_company">
                    </div>
                    <div class="form-group">
                        <input type="text"  placeholder="Dominio de la empresa"   class="form-control register-form" id="register_user_company_domain">
                    </div>

                    <div class="form-group">
                        <label class="col-sm-6 control-label">¿Representa usted una franquicia?</label>
                        <div class="col-sm-6">

                            <div class="be-radio inline">
                                <input type="radio" name="franchise-radio" value="0" checked="checked" class="register-franchise-radio"  id="register-franchise-radio-no" >
                                <label for="register-franchise-radio-no">No</label>
                            </div>

                            <div class="be-radio inline">
                                <input type="radio" name="franchise-radio" value="1" class="register-franchise-radio"  id="register-franchise-radio-yes" >
                                <label for="register-franchise-radio-yes">Si</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <input type="number"  placeholder="Cantidad de puntos de venta"   class="form-control register-form" id="register_user_sub_comapnies">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control"  placeholder="Comentarios"  id="register_user_coments"></textarea>
                    </div>

                    <div class="form-group xs-pt-10">
                        <div class="be-checkbox">
                            <input type="checkbox" id="register_terms_and_conditions">
                            <label for="register_terms_and_conditions">By creating an account, you agree the <a href="#">terms and conditions</a>.</label>
                        </div>
                    </div>

                    <div class="form-group xs-pt-10">
                        <button type="button" class="btn btn-block btn-primary btn-xl" id="company_register_button">Sign Up</button>
                    </div>


                </form>
            </div>
        </div>
        <div class="splash-footer">&copy; 2017 AFI</div>
    </div>
</div>

<div id="register_mod" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="text-danger" id="register_mod_icon_container">
                        <span id="register_mod_icon" class="modal-main-icon mdi"></span>
                    </div>
                    <h3 id="register_mod_title"></h3>
                    <p id="register_mod_message"></p>
                    <div class="xs-mt-50" id="register_mod_footer">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default" id="register_mod_action_cancel_btn">Cancel</button>
                        <button type="button"  class="btn btn-space " id="register_mod_action_btn">Reintentar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
