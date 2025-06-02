    <div class="container mt-4">
        <h2>Find Your Flight</h2>
        <form action="flight_search_form_handler.php" method="GET">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="departure" class="form-control" placeholder="From" value="<?= htmlspecialchars($_GET['departure'] ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <input type="text" name="arrival" class="form-control" placeholder="To" value="<?= htmlspecialchars($_GET['arrival'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <input type="date" name="dateOfFlight" class="form-control" value="<?= htmlspecialchars($_GET['dateOfFlight'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="pax_count" placeholder="PAX number" value="<?= htmlspecialchars($_GET['pax_count'] ?? '') ?>">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </div>