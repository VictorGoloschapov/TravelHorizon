<div>
        <pre>
            <p class="fs-4 text-decoration-underline text-danger">Stack trace</p>
            <?php
            echo "<br>";
            echo "Submitted form result:<br>";

            echo "Departure airport:" . $departure . "<br>";
            echo "Departure airport:" . $arrival . "<br>";
            echo "date:" . $dateOfFlight . "<br>";
            echo "<br>";
            ?>
        </pre>
    </div>

    <h2>Flight Information</h2>
    <h2>Flights found <?php echo count($flights_offers["data"])?></h2>

    <?php foreach ($flights_offers["data"] as $offer): ?>
        <hr>
        <h2>Offer <?= $offer['id'] ?></h2>
        <p><strong>Source:</strong> <?= $offer['source'] ?></p>
        <p><strong>Дата последней продажи билета:</strong> <?= $offer['lastTicketingDate'] ?></p>
        <p><strong>Доступно мест:</strong> <?= $offer['numberOfBookableSeats'] ?></p>

        <?php foreach ($offer['itineraries'] as $itineraryIndex => $itinerary): ?>
            <h3>Маршрут #<?= $itineraryIndex + 1 ?> (Длительность: <?= $itinerary['duration'] ?>)</h3>
            <table>
                <thead>
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
                            <td><?= $segment['departure']['iataCode'] ?> @ <?= $segment['departure']['at'] ?></td>
                            <td><?= $segment['arrival']['iataCode'] ?> @ <?= $segment['arrival']['at'] ?></td>
                            <td><?= $segment['carrierCode'] ?></td>
                            <td><?= $segment['number'] ?></td>
                            <td><?= $segment['aircraft']['code'] ?></td>
                            <td><?= $segment['duration'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

        <h3>Цена</h3>
        <p><strong>Общая:</strong> <?= $offer['price']['grandTotal'] ?> <?= $offer['price']['currency'] ?> (Базовая: <?= $offer['price']['base'] ?>)</p>
       
        <?php if (!empty($offer['price']['additionalServices'])): ?>
            <h4>Дополнительные услуги:</h4>
            <ul>
                <?php foreach ($offer['price']['additionalServices'] as $service): ?>
                    <li><?= $service['type'] ?>: <?= $service['amount'] ?> <?= $offer['price']['currency'] ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php foreach ($offer['travelerPricings'] as $traveler): ?>
            <h3>Пассажир: <?= $traveler['travelerType'] ?> — <?= $traveler['price']['total'] ?> <?= $traveler['price']['currency'] ?></h3>
            <table>
                <thead>
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
                                <ul>
                                    <?php foreach ($seg['amenities'] as $amenity): ?>
                                        <li>
                                            <?= $amenity['description'] ?>
                                            <?= $amenity['isChargeable'] ? ' (€)' : ' (вкл.)' ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endforeach; ?>

    <?php endforeach; ?>
</body>