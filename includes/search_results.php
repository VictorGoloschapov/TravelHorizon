<div class="container my-5">
    <h2 class="mb-4">Найдено рейсов: <?= count($flights_offers["data"]) ?></h2>

    <?php foreach ($flights_offers["data"] as $offer): ?>
        <div class="card mb-5 shadow">
            <div class="card-body">
                <h4 class="card-title mb-3">Оффер #<?= $offer['id'] ?> — <span class="text-success"><?= $offer['price']['grandTotal'] ?> <?= $offer['price']['currency'] ?></span></h4>
                <p class="text-muted mb-2">
                    Источник: <?= $offer['source'] ?> • Мест: <?= $offer['numberOfBookableSeats'] ?> • Последняя продажа: <?= $offer['lastTicketingDate'] ?>
                </p>

                <?php foreach ($offer['itineraries'] as $itineraryIndex => $itinerary): ?>
                    <h5 class="mt-4">Маршрут #<?= $itineraryIndex + 1 ?> <small class="text-muted">(<?= $itinerary['duration'] ?>)</small></h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm mt-2">
                            <thead class="table-light">
                                <tr>
                                    <th>№</th>
                                    <th>Отправление</th>
                                    <th>Прибытие</th>
                                    <th>Авиакомпания</th>
                                    <th>Рейс</th>
                                    <th>Самолёт</th>
                                    <th>Длительность</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($itinerary['segments'] as $segmentIndex => $segment): ?>
                                    <tr>
                                        <td><?= $segmentIndex + 1 ?></td>
                                        <td><?= $segment['departure']['iataCode'] ?> <br><small><?= $segment['departure']['at'] ?></small></td>
                                        <td><?= $segment['arrival']['iataCode'] ?> <br><small><?= $segment['arrival']['at'] ?></small></td>
                                        <td><?= $segment['carrierCode'] ?></td>
                                        <td><?= $segment['number'] ?></td>
                                        <td><?= $segment['aircraft']['code'] ?></td>
                                        <td><?= $segment['duration'] ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>

                <?php if (!empty($offer['price']['additionalServices'])): ?>
                    <h6 class="mt-4">Дополнительные услуги</h6>
                    <ul class="list-group list-group-flush mb-3">
                        <?php foreach ($offer['price']['additionalServices'] as $service): ?>
                            <li class="list-group-item">
                                <?= $service['type'] ?> — <?= $service['amount'] ?> <?= $offer['price']['currency'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

                <?php foreach ($offer['travelerPricings'] as $traveler): ?>
                    <div class="alert alert-secondary">
                        <h6>Пассажир: <?= $traveler['travelerType'] ?> — <?= $traveler['price']['total'] ?> <?= $traveler['price']['currency'] ?></h6>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm mt-2">
                                <thead class="table-light">
                                    <tr>
                                        <th>Сегмент</th>
                                        <th>Класс</th>
                                        <th>Тариф</th>
                                        <th>Багаж</th>
                                        <th>Услуги</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($traveler['fareDetailsBySegment'] as $seg): ?>
                                        <tr>
                                            <td><?= $seg['segmentId'] ?></td>
                                            <td><?= $seg['cabin'] ?> (<?= $seg['class'] ?>)</td>
                                            <td><?= $seg['brandedFareLabel'] ?> / <?= $seg['fareBasis'] ?></td>
                                            <td>Сдаваемый: <?= $seg['includedCheckedBags']['quantity'] ?> / Ручной: <?= $seg['includedCabinBags']['quantity'] ?></td>
                                            <td>
                                                <ul class="mb-0 ps-3">
                                                    <?php foreach ($seg['amenities'] as $amenity): ?>
                                                        <li>
                                                            <?= $amenity['description'] ?><?= $amenity['isChargeable'] ? ' (€)' : ' (вкл.)' ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>

                <a href="index.php?page=flight_search" class="btn btn-outline-primary mt-3">← Вернуться к поиску</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>