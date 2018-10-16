<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Admin users</div>
                </div>
                <div class="col s12 m1 l1">
                    <a href="admins/create" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">add</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content"> 
                    <table class="responsive-table" id="admin_users_table">
                        <thead>
                            <tr> 
                                <th data-field="name">Name</th>
                                <th data-field="price">Email</th>
                                <th data-field="price">Status</th>
                                <th data-field="price">Profile</th>
                                <th data-field="price">Edit</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($user_admin_list) {
                                while ($user = $user_admin_list->fetch_assoc()) {

                                    $email = $user["email"];
                                    $name = $user["name"] . " " . $user["last_name"];
                                    $status = "Enabled";
                                    if ($user["status"] == 0) {
                                        $status = "Disabled";
                                    }



                                    echo "<tr  >"
                                    . "<td> " . $name . " </td>"
                                    . "<td> " . $email . " </td>"
                                    . "<td> " . $status . " </td>"
                                    . "<td> "
                                    . "<a data-id='" . $user["id_admin"] . "' class='btn_see_admin btn-floating btn-mini waves-effect waves-light green'>"
                                    . "<i class='material-icons'>visibility</i></a>"
                                    . "</td>"
                                    . "<td> "
                                    . "<a data-id='" . $user["id_admin"] . "' class='btn_edit_admin btn-floating btn-mini waves-effect waves-light blue'>"
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

<div id="admin_profile_modal" class="modal">
    <div class="modal-content">


        <div class="row">

            <div class="col s12 m12 l12">

                <div class="card">
                    <div class="card-content"> 
                        <ul class="collection" style="margin: 0px!important;">

                            <li class="collection-item"> 
                                <span class="title"><b>Name:</b></span>
                                <span class="title" id="admin_profile_name" style="font-weight: normal!important;">Title</span>                    
                            </li>

                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="admin_profile_status" style="font-weight: normal!important;">Title</span>                    
                            </li>

                            <li class="collection-item  "> 
                                <span class="title"><b>Email:</b></span>
                                <span class="title"  id="admin_profile_email" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Password:</b></span>
                                <span class="title"  id="admin_profile_pass" style="font-weight: normal!important;">Title</span>                  
                            </li>

                        </ul>

                    </div>  
                </div>  

            </div>
        </div>



    </div> 
</div>


<div id="admin_edit_profile_modal" class="modal"  >
    <div class="modal-content">


        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content center-align">
                        <form>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for=" " class="active">User status</label>

                                    <div class="switch m-b-md">
                                        <label>
                                            Disabled
                                            <input type="checkbox" id="admin_user_edit_status">
                                            <span class="lever"></span>
                                            Enabled
                                        </label>
                                    </div> 
                                </div> 
                            </div>
                            <br>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="First Name" id="admin_user_edit_name" type="text" class="validate">
                                    <label for="admin_user_edit_name" class="active">* First Name</label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Last name" id="admin_user_edit_last_name" type="text" class="validate">
                                    <label for="admin_user_edit_last_name" class="active">* Last name</label> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">

                                    <input placeholder="Email" id="admin_user_edit_email" type="text" class="validate  validate-form">
                                    <label for="admin_user_edit_email" class="active">* Email</label>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">

                                    <input placeholder="Password" id="admin_user_edit_password" type="text" class="validate  validate-form">
                                    <label for="admin_user_edit_password" class="active">* Password</label>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="button" id="admin_user_edit_btn" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">UPDATE</button> 

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div> 
    </div>
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