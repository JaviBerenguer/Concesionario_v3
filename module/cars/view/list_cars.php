<div id="contenido">
    <div class="container">
    	<div class="row">
    			<h3>LISTA DE COCHES</h3>
    	</div>
    	<div class="row">
    		<p><a href="index.php?page=controller_cars&op=create"><img src="view/img/nuevo.jpg"></a></p>
    		
    		<table class= "tabla">
                <tr>
                    <td width=100><b>id_coche</b></th>
                    <td width=100><b>license_number</b></th>
                    <td width=100><b>marca</b></th>
                    <th width=100><b>modelo</b></th>
                </tr>
                <?php
                    if ($rdo->num_rows === 0){
                        echo '<tr>';
                        echo '<td align="center"  colspan="3">NO HAY coches</td>';
                        echo '</tr>';
                    }else{
                        foreach ($rdo as $row) {
                       		echo '<tr>';
                    	   	echo '<td width=10>'. $row['id'] . '</td>';
                    	   	echo '<td width=10>'. $row['license_number'] . '</td>';
                    	   	echo '<td width=10>'. $row['brand'] . '</td>';
                            echo '<td width=10>'. $row['model'] . '</td>';
                    	   	echo '<td width=500>';
                    	   	// echo '<a class="Button_blue" href="index.php?page=controller_cars&op=read&id='.$row['id'].'">Read</a>';
                            //js
                            print("<div class='car' id='".$row['id']."'>Read</div>");
                            //js
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_green" href="index.php?page=controller_cars&op=update&id='.$row['id'].'">Update</a>';
                    	   	echo '&nbsp;';
                    	   	echo '<a class="Button_red" href="index.php?page=controller_cars&op=delete&id='.$row['id'].'">Delete</a>';
                    	   	echo '</td>';
                    	   	echo '</tr>';
                        }
                    }
                ?>
            </table>
    	</div>
    </div>
</div>

<!-- modal -->

<section id="read_modal">
    <div id="details_cars" hidden>
        <div id="details">
            <div id="container">
            id: <div id="id"></div></br>
            license_number: <div id="license_number"></div></br>
            brand: <div id="brand"></div></br>
            model: <div id="model"></div></br>
            car_plate: <div id="car_plate"></div></br>
            km: <div id="km"></div></br>
            category: <div id="category"></div></br>
            type: <div id="type"></div></br>
            comments: <div id="comments"></div></br>
            discharge_date: <div id="discharge_date"></div></br>
            color: <div id="color"></div></br>
            extras: <div id="extras"></div></br>
            car_image: <div id="car_image"></div></br>
            price: <div id="price"></div></br>
            doors: <div id="doors"></div></br>
            city: <div id="city"></div></br>
            lat: <div id="lat"></div></br>
            lng: <div id="lng"></div></br>
            </div>
        </div>
    </div>
</section>
