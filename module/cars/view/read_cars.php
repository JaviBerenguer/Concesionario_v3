<div id="contenido">
    <h1>Informacion del Coche</h1>
    <p>
    <table border='2'>
        <tr>
            <td>id: </td>
            <td>
                <?php
                    echo $cars['id'];
                ?>
            </td>
        </tr>
    
        <tr>
            <td>license_number: </td>
            <td>
                <?php
                    echo $cars['license_number'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>brand: </td>
            <td>
                <?php
                    echo $cars['brand'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>model: </td>
            <td>
                <?php
                    echo $cars['model'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>car_plate: </td>
            <td>
                <?php
                    echo $cars['car_plate'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>km: </td>
            <td>
                <?php
                    echo $cars['km'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>category: </td>
            <td>
                <?php
                    echo $cars['category'];
                ?>
            </td>
            
        </tr>
        
        <tr>
            <td>type: </td>
            <td>
                <?php
                    echo $cars['type'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>comments: </td>
            <td>
                <?php
                    echo $cars['comments'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>discharge_date: </td>
            <td>
                <?php
                    echo $cars['discharge_date'];
                ?>
            </td>
        </tr>
        
        <tr>
            <td>color: </td>
            <td>
                <?php
                    echo $cars['color'];
                ?>
            </td>
        </tr>

        <tr>
            <td>extras: </td>
            <td>
                <?php
                    echo $cars['extras'];
                ?>
            </td>
        </tr>
        <tr>
            <td>car_image: </td>
            <td>
                <?php
                    echo $cars['car_image'];
                ?>
            </td>
        </tr>
        <tr>
            <td>price: </td>
            <td>
                <?php
                    echo $cars['price'];
                ?>
            </td>
        </tr>

        <tr>
            <td>doors: </td>
            <td>
                <?php
                    echo $cars['doors'];
                ?>
            </td>
        </tr>

        <tr>
            <td>city: </td>
            <td>
                <?php
                    echo $cars['city'];
                ?>
            </td>
        </tr>

        <tr>
            <td>lat: </td>
            <td>
                <?php
                    echo $cars['lat'];
                ?>
            </td>
        </tr>

        <tr>
            <td>lng: </td>
            <td>
                <?php
                    echo $cars['lng'];
                ?>
            </td>
        </tr>

    </table>
    </p>
    <p><a href="index.php?page=controller_cars&op=list">Volver</a></p>
</div>