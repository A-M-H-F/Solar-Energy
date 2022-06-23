<?php include('partials-front/menu.php'); ?>

<h3 class="contact-title">Solar Calculator</h3>

<div class="form">

<form >
                    
                    <div class="form-row" id="solar-flex-container">
                        <div class="form-group col-md-4" id="solar-flex-item-1">

                            <h5>Name of Appliance</h5>
                            <select class="form-select" aria-label="Default select example" id="s-1" list="appliances">
                                <option>Television</option>
                                <option>Room Cooler</option>
                                <option>AC</option>
                                <option>Refrigerator</option>
                                <option>Washing Machine</option>
                                <option>Light Bulb</option>
                                <option>Projector</option>
                                <option>Water Pump (0.5 HP)</option>
                                <option>Custom</option>
                            </select>
                            <datalist id="appliances">
                            </datalist>
                        </div>
    
                        <div class="form-group col-md-3" id="solar-flex-item-2">
                            <h5>Capacity in Watts</h5>
                            <input class="form-control" id="input" type="number" min=0>
                        </div>
    
                        <div class="form-group col-md-3" id="solar-flex-item-3">
                            <h5>Hours in use</h5>
                            <input class="form-control" id="hours" type="number" min=1>
                        </div>
                    </div>
                </form>

                <div class="cal-btn" id="solar-buttton">
                    <div class="" id="solar-add-button">
                        <button id="addBtn" class="btn btn-primary btn-4">ADD</button>
                    </div>
                    <div class="" id="solar-restart-button">
                        <button id="cancel" class="btn btn-primary btn-4">RESTART</button>
                    </div>
                </div>
                
                <div class="list-box" id="solar-details">
                    <h3>Device Details:</h3>
                    <ol id="list-parent-container"></ol>
                </div>
            
                <div id="totalWatts">Total Wattage = <span class="wattSpan">0</span></div>
            
                <div id="totalHours">Total Hours = <span class="hourSpan">0</span></div>
                <div id="calculate-btn">
                    <button id="calculate" class="btn btn-primary btn-4">CALCULATE</button>
                </div>
            
                <div class="result"></div>

                <div style="padding-bottom: 94px;"></div>

</div>


</div>
<?php include('partials-front/footer.php'); ?>