<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Registered services</div>
                </div>
                <div class="col s12 m1 l1">

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content"> 
                    <table class="responsive-table" id="registered_services_table">
                        <thead>
                            <tr>
                                <th data-field="id">Client</th>
                                <th data-field="name">Address</th>
                                <th data-field="price">Date</th>
                                <th data-field="price">Plan</th>
                                <th data-field="price">Status</th>
                                <th data-field="price">Detail</th> 
                                <th data-field="price">Approve Payment</th> 
                                <th data-field="price">Assign HouseKeeping</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($registered_services_list != null) {
                                foreach ($registered_services_list as $registered_service) {
                                    $assign_button = "";
                                    $approve_button = "";
                                    $service_status = intval($registered_service["service_status"]);
                                    $detail_button = "<a data-status='" . $service_status . "'  data-id='" . $registered_service["id_service"] . "' class='btn_detail_service btn-floating btn-mini waves-effect waves-light blue'>"
                                            . "<i class='material-icons'>visibility</i></a>";

                                    $status_label = "<p>" . $registered_service["status"] . "</p>";


                                    switch ($service_status) {
                                        case 1:
                                            $status_label = "<p style='color:red;'>" . $registered_service["status"] . "</p>";
                                            break;
                                        case 2:
                                            $status_label = "<p style='color:orange;'>" . $registered_service["status"] . "</p>";
                                            $assign_button = "<a data-id='" . $registered_service["id_service"] . "' class='btn_assign_service btn-floating btn-mini waves-effect waves-light orange'>"
                                                    . "<i class='material-icons'>verified_user</i></a>";
                                            break;
                                        case 4:
                                            $status_label = "<p style='color:green;'>" . $registered_service["status"] . "</p>";
                                            break;
                                        case 11:
                                            $status_label = "<p style='color:red;'>" . $registered_service["status"] . "</p>";
                                            $approve_button = "<a data-id='" . $registered_service["id_service"] . "' class='btn_approve_payment_service btn-floating btn-mini waves-effect waves-light orange'>"
                                                    . "<i class='material-icons'>spellcheck</i></a>";
                                            break;
                                    }


                                    echo "<tr>"
                                    . "<td> " . $registered_service["client_name"] . " </td>"
                                    . "<td> " . $registered_service["place_address"] . " </td>"
                                    . "<td> " . $registered_service["date"] . " </td>"
                                    . "<td> " . $registered_service["plan_name"] . " </td>"
                                    . "<td> " . $status_label . " </td>"
                                    . "<td> "
                                    . $detail_button
                                    . "</td>"
                                    . "<td> "
                                    . $approve_button
                                    . "</td>"
                                    . "<td> "
                                    . $assign_button
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

<div id="assing_service_detail_modal" class="modal" style="width: 92%!important;">
    <div class="modal-content">
        <div class="row">
            <div class="col s12 m6 l6">
                <span class="title"><b>Client info</b></span>
                <br>
                <div class="card">
                    <div class="card-content "> 
                        <ul class="collection" style="margin: 0px!important;">
                            <li class="collection-item"> 
                                <span class="title"><b>Client:</b></span>
                                <span class="title" id="svc_dtl_client_name" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="svc_dtl_service_status" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Address:</b></span>
                                <span class="title" id="svc_dtl_client_address" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Date:</b></span>
                                <span class="title"  id="svc_dtl_service_date" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Plan:</b></span>
                                <span class="title"  id="svc_dtl_service_plan" style="font-weight: normal!important;">Title</span>                  
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col s12 m6 l6" id="service_houserkeeping_info_container">

                <span class="title"><b>HouseKeeping info</b></span>
                <br>

                <div class="card">
                    <div class="card-content "> 



                        <ul class="collection" style="margin: 0px!important;">

                            <li class="collection-item"> 
                                <span class="title"><img id="svc_dtl_cleaning_photo" style="height:200px!important;"/></span>
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Name:</b></span>
                                <span class="title" id="svc_dtl_cleaning_name" style="font-weight: normal!important;">Title</span>                    
                            </li>


                            <li class="collection-item"> 
                                <span class="title"><b>Email:</b></span>
                                <span class="title" id="svc_dtl_cleaning_email" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Phone:</b></span>
                                <span class="title"  id="svc_dtl_cleaning_phone" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Other phone:</b></span>
                                <span class="title"  id="svc_dtl_cleaning_other_phone" style="font-weight: normal!important;">Title</span>                  
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div id="assing_service_housekeeping_modal" class="modal" style="width: 92%!important;">
    <div class="modal-content">




        <div class="row">
            <div class="col s12 m6 l6">

                <span class="title"><b>Client info</b></span>
                <br>

                <div class="card">
                    <div class="card-content "> 



                        <ul class="collection" style="margin: 0px!important;">


                            <li class="collection-item"> 
                                <span class="title"><b>Client:</b></span>
                                <span class="title" id="assing_service_client" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="assing_service_status" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Address:</b></span>
                                <span class="title" id="assing_service_address" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Date:</b></span>
                                <span class="title"  id="assing_service_date" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Plan:</b></span>
                                <span class="title"  id="assing_service_plan" style="font-weight: normal!important;">Title</span>                  
                            </li>


                        </ul>
                    </div>
                </div>


                <div class="col s12 "> 
                    <a id="assing_housekeeping_to_service" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Assing HouseKeeping</a> 
                </div>


            </div>
            <div class="col s12 m6 l6">
                <span class="title"><b>Housekeeping list</b></span>
                <br>
                <div class="card">
                    <div class="card-content"> 
                        <table class="responsive-table" id="cleaning_users_for_assing_table" >
                            <thead>
                                <tr>
                                    <th data-field="id">Photo</th>
                                    <th data-field="name">Name</th>
                                    <th data-field="price">Email</th>
                                    <th data-field="price">Select</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($cleaning_user_list) {

                                    $count = 0;

                                    while ($user = $cleaning_user_list->fetch_assoc()) {


                                        $radio_checked = "checked='checked'";

                                        if ($count > 0) {
                                            $radio_checked = "";
                                        }

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
                                        . "<td> " . $name . " </td>"
                                        . "<td> " . $email . " </td>"
                                        . "<td> "
                                        . "<p class='p-v-xs'>"
                                        . "<input " . $radio_checked . "  data-id='" . $user["id_housekeeping"] . "' class='with-gap select_housekeeping' name='housekeepingselect' type='radio' id='" . $user["id_housekeeping"] . "'  />"
                                        . "<label for='" . $user["id_housekeeping"] . "'></label>"
                                        . "</p>"
                                        . "</td>"
                                        . "</tr>";

                                        $count++;
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
</div>
<div id="sure_approve_payment" class="modal">
    <div class="modal-content">
        <h4 >Are you sure to approve the payment of this service?</h4>
        <p>Once the payment is approved, the client will be notified via email</p>
    </div>
    <div class="modal-footer">
        <a  id="confirm_approve_payment" class=" modal-action   waves-effect waves-green btn-flat">Approve</a>
        <a  id="cancel_approve_payment" class=" modal-action modal-close waves-effect waves-red btn-flat">Cancel</a>
    </div>
</div>

<div id="approve_payment_service_modal" class="modal" style="width: 92%!important;">
    <div class="modal-content">




        <div class="row">
            <div class="col s12 m6 l6">

                <span class="title"><b>Client info</b></span>
                <br>

                <div class="card">
                    <div class="card-content "> 



                        <ul class="collection" style="margin: 0px!important;">


                            <li class="collection-item"> 
                                <span class="title"><b>Client:</b></span>
                                <span class="title" id="approve_payment_client" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="approve_payment_status" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Address:</b></span>
                                <span class="title" id="approve_payment_address" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Register date:</b></span>
                                <span class="title"  id="approve_payment_service_date" style="font-weight: normal!important;">Title</span>                   
                            </li>



                        </ul>
                    </div>
                </div>





            </div>
            <div class="col s12 m6 l6">
                <span class="title"><b>Payment Information</b></span>
                <br>
                <div class="card">
                    <div class="card-content"> 
                        <ul class="collection" style="margin: 0px!important;">


                            <li class="collection-item  "> 
                                <span class="title"><b>Plan:</b></span>
                                <span class="title"  id="approve_payment_plan" style="font-weight: normal!important;">Title</span>                  
                            </li>

                            <li class="collection-item  "> 
                                <span class="title"><b>Description:</b></span>
                                <span class="title"  id="approve_payment_plan_desc" style="font-weight: normal!important;">Title</span>                  
                            </li>

                            <li class="collection-item"> 
                                <span class="title"><b>Category:</b></span>
                                <span class="title" id="approve_payment_category" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Register payment date:</b></span>
                                <span class="title" id="approve_payment_register_date" style="font-weight: normal!important;">Title</span>                    
                            </li>
                            <li class="collection-item"> 
                                <span class="title"><b>Total:</b></span>
                                <span class="title" id="approve_payment_total" style="font-weight: normal!important;">Title</span>                    
                            </li>



                        </ul>
                    </div>  
                </div>  

                <div class="col s12 "> 
                    <a id="approve_recurring_payment_service" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">Approve Payment</a> 
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
                                <label for="cleaning_user_edit_name" class="active">First Name</label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input placeholder="Last name" id="cleaning_user_edit_last_name" type="text" class="validate">
                                <label for="cleaning_user_edit_last_name" class="active">Last name</label> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">

                                <input placeholder="Medicare" id="cleaning_user_edit_medicare" type="text" class="validate  validate-form">
                                <label for="cleaning_user_edit_medicare" class="active">Medicare</label>  
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
                                    <label for="cleaning_user_edit_email" class="active">Email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Home address"  id="cleaning_user_edit_address" type="text" class="validate validate-form">
                                    <label for="cleaning_user_edit_address" class="active">Home address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input  placeholder="Phone" id="cleaning_user_edit_phone" type="text" class="validate validate-form">
                                    <label for="cleaning_user_edit_phone" class="active">Phone</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input   placeholder="Other phone"id="cleaning_user_edit_other_phone" type="text" class="validate validate-form">
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