<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Create admin user</div>
                </div>
               <div class="col s12 m1 l1">
                    <a href="<?php echo PROYECT_ROOT . "admins" ?>" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">arrow_back</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <form class="col s12">

                            <div class="row" style="margin-bottom: 0px!important;">
                                <div class="col s12">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="create_admin_name" type="text" class="validate validate-form">
                                            <label for="create_admin_name">* First Name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="create_admin_last_name" type="text" class="validate validate-form">
                                            <label for="create_admin_last_name">* Last name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="create_admin_email" type="text" class="validate validate-form">
                                            <label for="create_admin_email">* Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="create_admin_pass" type="text" class="validate validate-form">
                                            <label for="create_admin_email">* Password</label>
                                        </div>
                                    </div>
                                 

                                </div>   

                            </div>   
                            <div class="col s12 "> 
                                <a id="create_admin_btn" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Create</a> 
                            </div>


                            <div id="admin_error_modal" class="modal">
                                <div class="modal-content">
                                    <h4 id="admin_error_modal_title"></h4>
                                    <p  id="admin_error_modal_desc"></p>
                                </div>
                                <div class="modal-footer">
                                    <a  id="trigger_admin_error_modal_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
