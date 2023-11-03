<div id="contenido">
    <form autocomplete="on" method="post" name="aupdate_cars" id="update_cars" onsubmit="return validate();" action="index.php?page=controller_cars&op=update">
        <h1>Update</h1>
        <table border='0'> 
            <!-- <tr>
                <td>id del coche </td>
                <td><input type="text" id="id" name="id" placeholder="id" value="<?php echo $cars['id']; ?>" readonly /></td>
                <td>
                    <font color="red">
                        <span id="error_id" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>  -->

            <tr>
                <td>license_number: </td>
                <td><input type="text" id="license_number" name="license_number" placeholder="license_number" value="<?php echo $cars['license_number']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_license_number" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>brand: </td>
                <td><input type="text" id="brand" name="brand" placeholder="brand" value="<?php echo $cars['brand']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_brand" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>model: </td>
                <td><input type="text" id="model" name="model" placeholder="model" value="<?php echo $cars['model']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_model" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>car_plate: </td>
                <td><input type="text" id="car_plate" name="car_plate" placeholder="car_plate" value="<?php echo $cars['car_plate']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_car_plate" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>km: </td>
                <td><input type="text" id="km" name="km" placeholder="km" value="<?php echo $cars['km']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_km" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>category: </td>
                <td>
                    <?php
                    if ($cars['category'] === "KM0") {
                    ?>
                        <input type="radio" id="category" name="category" placeholder="category" value="KM0" checked />KM0
                        <input type="radio" id="category" name="category" placeholder="category" value="RT" />RT
                        <input type="radio" id="category" name="category" placeholder="category" value="SM" />SM
                    <?php
                    } elseif ($cars['category'] === "RT") {
                    ?>
                        <input type="radio" id="category" name="category" placeholder="category" value="KM0"  />KM0
                        <input type="radio" id="category" name="category" placeholder="category" value="RT" checked />RT
                        <input type="radio" id="category" name="category" placeholder="category" value="SM" />SM
                    <?php
                    } elseif ($cars['category'] === "SM") {
                    ?>
                        <input type="radio" id="category" name="category" placeholder="category" value="KM0" />KM0
                        <input type="radio" id="category" name="category" placeholder="category" value="RT" />RT
                        <input type="radio" id="category" name="category" placeholder="category" value="SM" checked />SM
                    <?php
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>type: </td>
                <td>
                    <?php
                    if ($cars['type'] === "GS") {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" checked />Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" />Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="OT" />Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" />Hibrid
                    <?php
                    } elseif ($cars['type'] === "ET") {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" />Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" checked />Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="OT" />Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" />Hibrid
                    <?php
                    } elseif ($cars['type'] === "OT") {
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" />Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" />Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="OT" checked />Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" />Hibrid
                    <?php
                    } elseif ($cars['type'] === "HB"){
                    ?>
                        <input type="radio" id="type" name="type" placeholder="type" value="GS" />Gasoline
                        <input type="radio" id="type" name="type" placeholder="type" value="ET" />Electric
                        <input type="radio" id="type" name="type" placeholder="type" value="OT" />Diesel
                        <input type="radio" id="type" name="type" placeholder="type" value="HB" checked />Hibrid
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>comments: </td>
                <td><input id="type" type="text" name="comments" placeholder="comments" value="<?php echo $cars['comments']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_comments" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td class="form_table_label">discharge_date: </td>
                <td><input id="fecha" type="text" name="discharge_date" placeholder="dd/mm/yyyy" value="<?php echo $id['discharge_date'];?>"/></td>
                <td><font color="red">
                    <span id="error_discharge_date" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td>color: </td>
                <td><input id="type" type="text" name="color" placeholder="color" value="<?php echo $cars['color']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_color" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>extras: </td>
                <td><input id="type" type="text" name="extras" placeholder="extras" value="<?php echo $cars['extras']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_extras" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>car_image: </td>
                <td><input id="type" type="text" name="car_image" placeholder="car_image" value="<?php echo $cars['car_image']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_car_image" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>price: </td>
                <td><input id="type" type="text" name="price" placeholder="price" value="<?php echo $cars['price']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_price" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>doors: </td>
                <td>
                    <?php
                    if ($cars['doors'] === "3") {
                    ?>
                        <input type="radio" doors="radio" id="doors" name="doors" placeholder="doors" value="3" checked />3
                        <input type="radio" doors="radio" id="doors" name="doors" placeholder="doors" value="5" />5

                    <?php
                    } elseif ($cars['doors'] === "5"){
                    ?>
                        <input type="radio" doors="radio" id="doors" name="doors" placeholder="doors" value="3" />3
                        <input type="radio" doors="radio" id="doors" name="doors" placeholder="doors" value="5" checked />5

                    <?php
                    }
                    ?>
                </td>
            </tr>

            <tr>
                <td>city: </td>
                <td><input id="type" type="text" name="city" placeholder="city" value="<?php echo $cars['city']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_city" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>lat: </td>
                <td><input id="type" type="text" name="lat" placeholder="lat" value="<?php echo $cars['lat']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_lat" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>lng: </td>
                <td><input id="type" type="text" name="lng" placeholder="lng" value="<?php echo $cars['lng']; ?>" /></td>
                <td>
                    <font color="red">
                        <span id="error_lng" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            

            <tr>
                <td><input type="submit" name="update" id="update" /></td>
                <td align="right"><a href="index.php?page=controller_cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>