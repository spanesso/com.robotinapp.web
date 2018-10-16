<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Create cleaning employees</div>
                </div>
                 <div class="col s12 m1 l1">
                    <a href="<?php echo PROYECT_ROOT . "cleaning_users" ?>" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">arrow_back</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content">
                    <div class="row">
                        <form class="col s12">

                            <div class="row" style="margin-bottom: 0px!important;">
                                <div class="col s6">
                                    <div class="row">
                                        <div class="col s12">
                                           
                                            <img  style="width: 200px; height: 200px; "  id="cleaning_user_photo" class="img-center circle" src="<?php echo IMG . "profile_user_icon.png" ?>" alt="">
                                             <br>
                                            <input  id="cleaning_user_photo_select_file" type="file"  style="width: 0px; height: 0px; overflow: hidden;" >


                                            <button type="button" id="cleaning_user_photo_change_image" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Select image</button> 


                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_name" type="text" class="validate validate-form">
                                            <label for="cleaning_user_name">* First name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_last_name" type="text" class="validate validate-form">
                                            <label for="cleaning_user_last_name">* Last name</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_medicare" type="text" class="validate validate-form" data-inputmask="'numericInput': true, 'mask': '999-99-9999', 'rightAlignNumerics':false">
                                            <label for="cleaning_user_medicare">* Social security</label>
                                        </div>
                                    </div>

                                </div>   
                                <div class="col s6">

                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_email" type="email" class="validate validate-form">
                                            <label for="cleaning_user_email">* Email</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_birthdate" type="text" class="validate validate-form"  data-inputmask="'mask': 'd/m/y'">
                                            <label for="cleaning_user_birthdate" class="active">* Birthdate</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_address" type="text" class="validate validate-form">
                                            <label for="cleaning_user_address">* Home address</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_phone" type="text" class="validate validate-form">
                                            <label for="cleaning_user_phone">* Phone</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="cleaning_user_other_phone" type="text" class="validate">
                                            <label for="cleaning_user_other_phone">Other phone</label>
                                        </div>
                                    </div>

                                </div>   
                            </div>   
                            <div class="col s12 "> 
                                <a id="cleaning_user_create_button" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Create</a> 
                            </div>
                            
                             <div id="cleaning_user_modal" class="modal">
                                        <div class="modal-content">
                                            <h4 id="cleaning_user_modal_title"></h4>
                                            <p  id="cleaning_user_modal_desc"></p>
                                        </div>
                                        <div class="modal-footer">
                                            <a  id="cleaning_user_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
