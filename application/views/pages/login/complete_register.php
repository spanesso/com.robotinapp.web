<div class="main-content container-fluid">
    <div class="sign-up">
        <div class="panel panel-default panel-border-color panel-border-color-primary">
            <div class="panel-heading"> <span class="splash-description">Complete register</span></div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-sm-6">

                        <form   class="form-horizontal group-border-dashed">

                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img id="complete_register_company_img" src="<?php echo IMG . "system/company_icon.png" ?>" alt="logo" class=" img-circle  center-img" width="150" height="150">
                                    </div>
                                    <div class="col-sm-8">

                                        <div class="panel-heading ">
                                            Imagen de la empresa
                                            <span class="panel-subtitle">Selecciona una imagen de tu empresa para la plataforma AFI.</span>
                                            <input type="file" name="company_logo_file" id="company_logo_file" data-multiple-caption="{count} files selected" multiple class="inputfile">
                                            <label for="company_logo_file" class="btn-primary"> 
                                                <i class="mdi mdi-upload"></i><span>Seleccionar imagen...</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre de la empresa</label>
                                <div class="col-sm-9">
                                    <input type="text"  placeholder="Nombre de la empresa" value="<?php echo $enterprise["company_name"]; ?>" class="form-control complete-register-form" id="complete_register_company_name">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Categoría del negocio</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="complete_register_category">
                                        <option value="0">Seleccione...</option>

                                        <?php
                                        if ($category_list) {
                                            while ($category = $category_list->fetch_assoc()) {
                                                echo "<option value='" . $category["category_id"] . "'>" . $category["category_name"] . "</option>";
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group hide" id="complete_register_sub_category_panel">
                                <label class="col-sm-3 control-label">Sub-Categoría del negocio</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="complete_sub_register_category">
                                        <option value="0">Seleccione...</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="panel-heading panel-heading-divider">
                                    <span class="panel-subtitle">Horario de atención</span>
                                    <div id="button_add_schedule_hour_container" style="float: right;
                                         margin-top: -20px;" class="btn btn-rounded btn-space btn-success">
                                        <i class="icon icon-left mdi mdi-alarm-plus"></i> 
                                        Agregar horario
                                    </div>
                                </div>
                                <div class="panel-body" id="schedule_container">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form   class="form-horizontal group-border-dashed">
                            <div class="panel-heading">
                                <img id="complete_register_company_banner_img" src="<?php echo IMG . "system/company_banner.png" ?>" alt="banner" class="company-banner"  >
                                <div class="panel-heading ">
                                    Imagen de la empresa
                                    <span class="panel-subtitle">Selecciona una imagen de tu empresa para la plataforma AFI.</span>
                                    <input type="file" name="company_banner_file" id="company_banner_file" data-multiple-caption="{count} files selected" multiple class="inputfile">
                                    <label for="company_banner_file" class="btn-primary"> 
                                        <i class="mdi mdi-upload"></i><span>Seleccionar imagen...</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Nombre contpacto principal</label>
                                <div class="col-sm-9">
                                    <input type="text"  placeholder="Nombre contpacto principal"  value="<?php echo $enterprise["user_name"]; ?>"  class="form-control complete-register-form" id="complete_register_user_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Correo electrónico</label>
                                <div class="col-sm-9">
                                    <input type="email"  placeholder="Correo electrónico"  value="<?php echo $enterprise["user_email"]; ?>"  class="form-control complete-register-form" id="complete_register_user_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Teléfono</label>
                                <div class="col-sm-9">
                                    <input type="tel"  placeholder="Teléfono"  value="<?php echo $enterprise["user_tel"]; ?>"  class="form-control complete-register-form" id="complete_register_user_tel">
                                </div>
                            </div>
                            <br>
                            <div id="button_complete_register" class="btn btn-space btn-success" style="float: right;" company="<?php echo $enterprise["company_id"]; ?>"><i class="icon icon-left mdi mdi-check"></i> Completar Registro</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="splash-footer">&copy; 2017 AFI</div>
    </div>
</div>


<div id="comple_register_mod" tabindex="-1" role="dialog" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="text-center">
                    <div class="text-danger" id="comple_register_mod_icon_container">
                        <span id="comple_register_mod_icon" class="modal-main-icon mdi"></span>
                    </div>
                    <h3 id="comple_register_mod_title"></h3>
                    <p id="comple_register_mod_message"></p>
                    <div class="xs-mt-50" id="comple_register_mod_footer">
                        <button type="button" data-dismiss="modal" class="btn btn-space btn-default" id="comple_register_mod_action_cancel_btn">Cancel</button>
                        <button type="button"  class="btn btn-space " id="comple_register_mod_action_btn">Reintentar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
