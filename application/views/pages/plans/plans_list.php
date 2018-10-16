<div class="middle-content">
    <div class="row">
        <div class="col s12 m12 l12">
            <div class="row" style="margin-bottom: 0px!important;">
                <div class="col s12 m11 l11">
                    <div class="page-title">Plans</div>
                </div>
                <div class="col s12 m1 l1">
                    <a href="plans/create" class="btn-floating btn-large waves-effect waves-light blue"><i class="large material-icons">add</i></a>

                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-content"> 
                    <table class="responsive-table" id="plans_table">
                        <thead>
                            <tr> 
                                <th data-field="name">Name</th>
                                <th data-field="price">Category</th>
                                <th data-field="price">Price</th>
                                <th data-field="price">Status</th>
                                <th data-field="price">View</th>
                                <th data-field="price">Edit</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($plans_list) {
                                while ($plan = $plans_list->fetch_assoc()) {
                                    $category = $plan["category"];
                                    $name = $plan["name"];
                                    $price = $plan["price"];
                                    $id_plan = $plan["id_plan"];

                                    $status = "Enabled";
                                    if ($plan["status"] == 0) {
                                        $status = "Disabled";
                                    }



                                    echo "<tr  >"
                                    . "<td> " . $name . " </td>"
                                    . "<td> " . $category . " </td>"
                                    . "<td> " . $price . " </td>"
                                    . "<td> " . $status . " </td>"
                                    . "<td> "
                                    . "<a data-id='" . $id_plan . "' class='btn_see_plan btn-floating btn-mini waves-effect waves-light green'>"
                                    . "<i class='material-icons'>visibility</i></a>"
                                    . "</td>"
                                    . "<td> "
                                    . "<a data-id='" . $id_plan . "' class='btn_edit_plan btn-floating btn-mini waves-effect waves-light blue'>"
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

<div id="plan_data_modal" class="modal">
    <div class="modal-content">


        <div class="row">

            <div class="col s12 m12 l12">

                <div class="card">
                    <div class="card-content"> 
                        <ul class="collection" style="margin: 0px!important;">

                            <li class="collection-item"> 
                                <span class="title"><b>Name:</b></span>
                                <span class="title" id="plan_data_name" style="font-weight: normal!important;">Title</span>                    
                            </li>

                            <li class="collection-item"> 
                                <span class="title"><b>Status:</b></span>
                                <span class="title" id="plan_data_status" style="font-weight: normal!important;">Title</span>                    
                            </li>

                            <li class="collection-item  "> 
                                <span class="title"><b>Category:</b></span>
                                <span class="title"  id="plan_data_category" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            
                            
                            <li class="collection-item" id="plan_data_url_payment_container"> 
                                <span class="title"><b>Recurring payment URL:</b></span>
                                <span class="title"  id="plan_data_url_payment" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            
                            <li class="collection-item  "> 
                                <span class="title"><b>Price:</b></span>
                                <span class="title"  id="plan_data_price" style="font-weight: normal!important;">Title</span>                   
                            </li>
                            <li class="collection-item  "> 
                                <span class="title"><b>Description:</b></span>
                                <span class="title"  id="plan_data_desc" style="font-weight: normal!important;">Title</span>                   
                            </li> 
                        </ul>

                    </div>  
                </div>  

            </div>
        </div>



    </div> 
</div>


<div id="plan_edit_modal" class="modal"  >
    <div class="modal-content">


        <div class="row">
            <div class="col s12 m12 l12">
                <div class="card">
                    <div class="card-content center-align">
                        <form>
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for=" " class="active">Plan status</label>

                                    <div class="switch m-b-md">
                                        <label>
                                            Disabled
                                            <input type="checkbox" id="plan_edit_status">
                                            <span class="lever"></span>
                                            Enabled
                                        </label>
                                    </div> 
                                </div> 
                            </div>
                            <br>

                            <input style="display: none;" id="plan_edit_old_category" type="text" >

                            <div class="row">
                                <div class="input-field col s12">

                                    <input placeholder="Name" id="plan_edit_name" type="text" class="validate  validate-form">
                                    <label for="plan_edit_name" class="active">* Name</label>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="plan_edit_category_select">
                                        <option value="" disabled selected  id="plan_edit_category_select_item">xxx</option>
                                        <?php
                                        if ($category_plans) {
                                            while ($category = $category_plans->fetch_assoc()) {
                                                echo "<option value='" . $category["id_category"] . "'>" . $category["name"] . "</option>";
                                            }
                                        }
                                        ?>   
                                    </select>
                                    <label>* Category</label>
                                </div>
                            </div>
                            <div class="row"  id="plan_edit_url_payment_container">
                                <div class="input-field col s12">

                                    <input placeholder="Recurring payment URL" id="plan_edit_url_payment" type="text" class="validate">
                                    <label for="plan_edit_url_payment" class="active">* Recurring payment URL</label>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">

                                    <input placeholder="Price" id="plan_edit_price" type="text" class="validate  validate-form">
                                    <label for="plan_edit_price" class="active">* Price</label>  
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea  placeholder="Description"  id="plan_edit_desc" class="materialize-textarea  validate-form" length="120"></textarea>
                                    <label for="plan_edit_desc">* Description</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button type="button" id="plan_edit_btn" class="waves-effect waves-light btn blue m-b-xs" style="width: 100%!important">UPDATE</button> 

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div> 
    </div>
</div>


<div id="plan_error_modal" class="modal">
    <div class="modal-content">
        <h4 id="plan_error_modal_title"></h4>
        <p  id="plan_error_modal_desc"></p>
    </div>
    <div class="modal-footer">
        <a  id="trigger_plan_error_modal_modal_button" class=" modal-action modal-close waves-effect waves-green btn-flat">Ok</a>
    </div>
</div>