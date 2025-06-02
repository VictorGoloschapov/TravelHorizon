<div class="page">
    <div class="container ">
        <h1 class="text-center">Travel Search Engine v<?php echo $devVersion?></h1>

        <form class="travel_search_form bg-body-tertiary" action="" method="GET">
            <div class="form_container d-flex justify-content-between">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Departure</label>
                    <input type="text" class="form-control" name="departure" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Arrival</label>
                    <input type="text" class="form-control" name="arrival" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">PAX Count</label>
                    <input type="text" class="form-control" name="pax_count" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="dateInput" class="form-label">Выберите дату</label>
                    <input type="date" name="dateOfFlight" class="form-control" id="dateInput">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>
    <div class="search_result bg-body-tertiary">
        <?php require_once "search_form_handler.php"?>
    </div>
</div>



