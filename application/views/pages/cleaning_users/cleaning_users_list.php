<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Cleaning employees</div>
                </div>
                <div class="col s12 m1 l1">
                    <a href="cleaning_users/create" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">add</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content"> 
                    <table class="responsive-table" id="cleaning_users_table">
                        <thead>
                            <tr>
                                <th data-field="id">Photo</th>
                                <th data-field="id">Code</th>
                                <th data-field="name">Name</th>
                                <th data-field="price">Email</th>
                                <th data-field="price">Status</th>
                                <th data-field="price">Profile</th>
                                <th data-field="price">Edit</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($cleaning_user_list) {
                                while ($user = $cleaning_user_list->fetch_assoc()) {

                                    $code = $user["code"];
                                    $email = $user["email"];
                                    $name = $user["name"] . " " . $user["last_name"];
                                    $status = "Enabled";
                                    if ($user["status"] == 0) {
                                        $status = "Disabled";
                                    }

                                    if ($user["photo"] != "") {
                                        $user_img = $user["photo"];
                                    }

                                    echo "<tr  >"
                                    . "<td> <img id='img_user_profile' class='circle img-list' src='" . $user_img . "' ></td>"
                                    . "<td> " . $code . " </td>"
                                    . "<td> " . $name . " </td>"
                                    . "<td> " . $email . " </td>"
                                    . "<td> " . $status . " </td>"
                                    . "<td> "
                                    . "<a data-id='" . $user["id_housekeeping"] . "' class='btn_see_housekeeping btn-floating btn-mini waves-effect waves-light green'>"
                                    . "<i class='material-icons'>visibility</i></a>"
                                    . "</td>"
                                    . "<td> "
                                    . "<a data-id='" . $user["id_housekeeping"] . "' class='btn_edit_housekeeping btn-floating btn-mini waves-effect waves-light blue'>"
                                    . "<i class='material-icons'class>mode_edit</i></a>"
                                    . "</td>"
                                    . "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="housekeeping_profile_modal" class="modal">
    <div class="modal-content">


        <div class="row">
            <div class="col s12 m6 l6">
                <div class="card">
                    <div class="card-content center-align">
                        <img  id="housekeeping_profile_img"
                              src="assets/images/profile-image-1.png" 
                              class="responsive-img circle" 
                              style="width: 140px!important;height: 140px!important;">
                        <br>
                        <p id="housekeeping_profile_name" class="m-t-lg flow-text" style="font-weight: bold!important;">David Wade</p> 
                   
                        <p id="housekeeping_profile_code" class="m-t-lg flow-text" style="font-weight: bold!important;">David Wade</p> 
                  
                    
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l6">

                <div class="card">
                    <div class="card-content"> 
                        <ul class="collection" style="margin: 0px!important;">

                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="housekeeping_profile_status" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Social security:</b></span>
                                <span class="title" id="housekeeping_profile_medicare" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Email:</b></span>
                                <span class="title"  id="housekeeping_profile_email" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Birthdate:</b></span>
                                <span class="title"  id="housekeeping_profile_birthdate" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Home address:</b></span>
                                <span class="title"  id="housekeeping_profile_addresss" style="font-weight: normal!important;">Title</span>                  
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Phone:</b></span>
                                <span class="title"  id="housekeeping_profile_phone" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Other phone:</b></span>
                                <span class="title"  id="housekeeping_profile_other_phone" style="font-weight: normal!important;">Title</span>                    
                            </li>
                        </ul>

                    </div>  
                </div>  

            </div>
        </div>



    </div> 
</div>


<div id="housekeeping_edit_profile_modal" class="modal" style="
     top:2%!important; 
     width: 70%!important;
     ">
    <div class="modal-content">


        <div class="row">
            <div class="col s12 m6 l6">
                <div class="card">
                    <div class="card-content center-align">
                        <img  id="housekeeping_edit_profile_img"
                              src="<?php echo IMG . "def-com/profile_user_icon.png" ?>" 
                              class="responsive-img circle" 
                              style="width: 140px!important;height: 140px!important;">

                        <input type="text" style="display: none;" id="housekeeping_edit_profile_img_old" >
                        <input type="text" style="display: none;" id="housekeeping_edit_profile_token" >
                        <input  id="housekeeping_edit_profile_img_photo_select_file" type="file"  style="width: 0px; height: 0px; overflow: hidden;" >
                        <button type="button" id="housekeeping_edit_profile_img_change_image" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Select image</button> 

                        <br>
                    </div>


                    <form>


                        <div class="row">
                            <div class="input-field col s12">
                                <label for=" " class="active">User status</label>

                                <div class="switch m-b-md">
                                    <label>
                                        Disabled
                                        <input type="checkbox" id="cleaning_user_edit_status">
                                        <span class="lever"></span>
                                        Enabled
                                    </label>
                                </div> 
                            </div> 
                        </div>
                        <br>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="First Name" id="cleaning_user_edit_name" type="text" class="validate">
                                <label for="cleaning_user_edit_name" class="active">* First Name</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Last name" id="cleaning_user_edit_last_name" type="text" class="validate">
                                <label for="cleaning_user_edit_last_name" class="active">* Last name</label> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">

                                <input placeholder="Medicare" id="cleaning_user_edit_medicare" type="text" class="validate  validate-form" data-inputmask="'numericInput': true, 'mask': '999-99-9999', 'rightAlignNumerics':false">
                                <label for="cleaning_user_edit_medicare" class="active">* Social security</label>  
                            </div>
                        </div>
                    </form>




                </div>
            </div>
            <div class="col s12 m6 l6">

                <div class="card">
                    <div class="card-content"> 

                        <form>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Email" id="cleaning_user_edit_email" type="email" class="validate validate-form">
                                    <label for="cleaning_user_edit_email" class="active">* Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Birthdate" id="cleaning_user_edit_birthdate" type="text" class="validate validate-form" data-inputmask="'mask': 'd/m/y'">
                                    <label for="cleaning_user_edit_birthdate" class="active">* Birthdate</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Home address"  id="cleaning_user_edit_address" type="text" class="validate validate-form">
                                    <label for="cleaning_user_edit_address" class="active">* Home address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input  placeholder="Phone" id="cleaning_user_edit_phone" type="text" class="validate validate-form">
                                    <label for="cleaning_user_edit_phone" class="active">* Phone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input   placeholder="Other phone"id="cleaning_user_edit_other_phone" type="text" class="validate">
                                    <label for="cleaning_user_edit_other_phone" class="active">Other phone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="button" id="cleaning_user_edit_btn" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">UPDATE</button> 

                                </div>
                            </div>
                        </form>
                    </div>  
                </div>  

            </div>
        </div>
    </div> 
</div>


<div id="housekeeping_error_modal" class="modal">
    <div class="modal-content">
        <h4 id="housekeeping_error_modal_title"></h4>
        <p  id="housekeeping_error_modal_desc"></p>
    </div>
    <div class="modal-footer">
        <a  id="trigger_housekeeping_error_modal_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
</div>