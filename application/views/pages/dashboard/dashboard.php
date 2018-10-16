<div class="middle-content">
    <div class="row no-m-t no-m-b">

        <div class="col s12 m12 l4">
            <div class="card stats-card">
                <div class="card-content">
                    <div class="row" style="margin-bottom: 0px!important;">
                        <div class="col s8">
                            <i class="material-icons dp48" style="font-size: 50px!important;">perm_identity</i>
                            <br>
                            <p class="card-title" style="margin-top: -10px;">Clients</p>
                        </div>

                        <div class="col s4">
                            <p class="" style="
                               font-size: 70px!important;
                               font-size: 90px!important;
                               margin-top: -25px!important;">
                               <?php echo 0; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l4">
            <div class="card stats-card">
                <div class="card-content">
                    <div class="row" style="margin-bottom: 0px!important;">
                        <div class="col s8">
                            <i class="material-icons dp48" style="font-size: 50px!important;">assignment_ind</i>
                            <br>
                            <p class="card-title" style="margin-top: -10px;">House keeping</p>
                        </div>

                        <div class="col s4">
                            <p class="" style="
                               font-size: 70px!important;
                               font-size: 90px!important;
                               margin-top: -25px!important;">
                               <?php echo $total_cleaning_user; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l4">
            <div class="card stats-card">
                <div class="card-content">
                    <div class="row" style="margin-bottom: 0px!important;">
                        <div class="col s8">
                            <i class="material-icons dp48" style="font-size: 50px!important;">turned_in_not</i>
                            <br>
                            <p class="card-title" style="margin-top: -10px;">Plans</p>
                        </div>

                        <div class="col s4">
                            <p class="" style="
                               font-size: 70px!important;
                               font-size: 90px!important;
                               margin-top: -25px!important;">
                               <?php echo $total_plans; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <div class="row no-m-t no-m-b" >
        <div class="col s12 m12 l8" >
            <div class="card stats-card">
                <div class="card-content" >
                    <div>
                        <canvas id="chart2" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12 m12 l4" >
            <div class="card stats-card">
                <div class="card-content" >
                    <div>
                        <canvas id="chart4" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="cheking_services_modal" class="modal">
    <div class="modal-content">


        <div class="row">
            <div class="col s12 m12 l12">
                <p id="housekeeping_profile_name" class="m-t-lg flow-text" style="font-weight: bold!important;">Verifying the expiration of the plans of the clients that are in service.</p> 
                <br>
                <div class="progress m-t-md">
                    <div class="indeterminate"></div>
                </div>

            </div> 
        </div>



    </div> 
</div>

