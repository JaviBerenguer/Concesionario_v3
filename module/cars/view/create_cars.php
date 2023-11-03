<!-- die('<script>console.log('Test create_cars');</script>'); -->
<!-- tested -->
<div id="contenido">
    <form autocomplete="on" method="post" name="alta_cars" id="alta_cars" onsubmit="return validate();" action="index.php?page=controller_cars&op=create">
        <h1>Crear coche</h1>
        <table border='0'>  
            <tr>
                <td>license_number: </td>
                <td><input type="text" id="license_number" name="license_number" placeholder="license_number" value="" /></td>
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
                <td><input type="text" id="brand" name="brand" placeholder="brand" value="" /></td>
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
                <td><input type="text" id="model" name="model" placeholder="model" value="" /></td>
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
                <td><input type="text" id="car_plate" name="car_plate" placeholder="car_plate" value="" /></td>
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
                <td><input type="text" id="km" name="km" placeholder="km" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_km" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>
            
            <tr>
                <td class="form_table_label">category: </td>
                <td>
                    <input type="radio" id="category" name="category" placeholder="category" value="KM0"/>KM0
                    <input type="radio" id="category" name="category" placeholder="category" value="RT"/>RT
                    <input type="radio" id="category" name="category" placeholder="category" value="SM"/>SM
                </td>
                <td><font color="red">
                    <span id="error_category" class="error"></span>
                </font></font></td>
            </tr>

            <tr>
                <td class="form_table_label">type: </td>
                <td>
                    <input type="radio" id="type" name="type" placeholder="type" value="Gasoline"/>Gasoline
                    <input type="radio" id="type" name="type" placeholder="type" value="Electric"/>Electric
                    <input type="radio" id="type" name="type" placeholder="type" value="Diesel"/>Diesel
                    <input type="radio" id="type" name="type" placeholder="type" value="Hibrid"/>Hibrid
                </td>
                <td><font color="red">
                    <span id="error_type" class="error"></span>
                </font></font></td>
            </tr>

            <!-- <tr>
                <td>category: </td>
                <td><input type="text" id="category" name="category" placeholder="category" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_category" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>type: </td>
                <td><input type="text" id="type" name="type" placeholder="type" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_type" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr> -->

            <tr>
                <td>comments: </td>
                <td><input type="text" id="comments" name="comments" placeholder="comments" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_comments" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td>discharge_date: </td>
                <td><input type="text" id="discharge_date" name="discharge_date" placeholder="discharge_date" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_discharge_date" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>
            
            <tr>
                <td>color: </td>
                <td><input type="text" id="color" name="color" placeholder="color" value="" /></td>
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
                <td><input type="text" id="extras" name="extras" placeholder="extras" value="" /></td>
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
                <td><input type="text" id="car_image" name="car_image" placeholder="car_image" value="" /></td>
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
                <td><input type="text" id="price" name="price" placeholder="price" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_price" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            <tr>
                <td class="form_table_label">doors: </td>
                <td>
                    <input type="radio" id="doors" name="doors" placeholder="doors" value="3"/>3
                    <input type="radio" id="doors" name="doors" placeholder="doors" value="5"/>5
                </td>
                <td><font color="red">
                    <span id="error_doors" class="error"></span>
                </font></font></td>
            </tr>


            <!-- <tr>
                <td>doors: </td>
                <td><input type="text" id="doors"  name="doors" placeholder="doors" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_doors" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr> -->
            
            <tr>
                <td>city: </td>
                <td><input type="text" id="city"  name="city" placeholder="city" value="" /></td>
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
                <td><input type="text" id="lat" name="lat" placeholder="lat" value="" /></td>
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
                <td><input type="text" id="lng" name="lng" placeholder="lng" value="" /></td>
                <td>
                    <font color="red">
                        <span id="error_lng" class="error">
                        </span>
                    </font>
                    </font>
                </td>
            </tr>

            

            <tr>
                <td><input type="submit" name="create" id="create" /></td>
                <td align="right"><a href="index.php?page=controller_cars&op=list">Volver</a></td>
            </tr>
        </table>
    </form>
</div>