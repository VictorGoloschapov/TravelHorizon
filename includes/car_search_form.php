    <div class="container mt-4">
        <h2>Find Your Car</h2>
        <form>
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="place" placeholder="place">
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="dateFrom">
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="dateTo">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control" name="numberOfGuests" placeholder="Guest number" value="<?= htmlspecialchars($_GET['pax_count'] ?? '') ?>">
                </div>
            </div>
        </form>
    </div>