
<?php

    require_once 'konekcija.php';
    $conn = dbConnect();
    
    
?>

<html>
    <head>
        <title>Zadatak->NTH MEDIA</title>
        <link href="stil.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        
        <table id="table1" border="2">
            <thead> 
                <td>   id    </td>
                <td>   productCode   </td>
                <td>   productName   </td>
                <td>   productLine    </td>
                <td>   textDescription   </td>
                <td>   productDescription   </td> 
            </thead>
            <tbody>
            <?php
                if($conn != null)
                {
                    $sql = "SELECT * FROM products as p "
                        . "   JOIN productslines as pr on p.productLine = pr.id_productLine order by p.id ASC ";
                    $stmt = $conn->prepare($sql);
                    $is_Query_Good = $stmt->execute();

                    if(!$is_Query_Good)
                    {
                        die("Upit neuspjesan: ");
                    } 
                    while($row = $stmt->fetch()) {
                        echo "<tr>";
                            echo "<td>".$row['id']."</td>";
                            echo "<td>".$row['productCode']."</td>";
                            echo "<td>".$row['productName']."</td>";
                            echo "<td>".$row['productLine']."</td>";
                            echo "<td>".$row['textDescription']."</td>";
                            echo "<td>".$row['productDescription']."</td>";
                        echo "</tr>";
                    }

                }
                else
                {
                    echo "nisam se uspio spojiti.";
                }
            ?>
            </tbody>
            
        </table>
        
        
         <div id="centarTablica">
            <form method='get'>
                <?PHP

                    //check if the starting row variable was passed in the URL or not
                    if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
                      //we give the value of the starting row to 0 because nothing was found in URL
                      $startrow = 0;
                    //otherwise we take the value from the URL
                    } else {
                      $startrow = (int)$_GET['startrow'];
                    }
                    //this part goes after the checking of the $_GET var
                    $sql = "SELECT * FROM products as p "
                    . "   JOIN productslines as pr on p.productLine = pr.id_productLine LIMIT $startrow, 20 ";
                    //$sql = "SELECT * FROM products  LIMIT $startrow, 20";
                    $stmt = $conn->prepare($sql); 

                    $is_Query_Good = $stmt->execute();

                    if(!$is_Query_Good)
                    {
                        die("Upit neuspjesan: ");
                    } 
                    $brojRedaka = $stmt->rowCount();
                    if( $stmt->rowCount() > 0 )
                    {
                        echo "<table  border=2>";
                        echo "<thead>"
                                . "<tr>"
                                    . "<td>id</td>"
                                    . "<td>productCode</td>"
                                    . "<td>productName</td>"
                                    . "<td>productLine</td>"
                                    . "<td>textDescription</td>"
                                    . "<td>productDescription</td>"
                                . "</tr>"
                            . "</thead>";
                        for($i=0;$i<$brojRedaka;$i++)
                        {
                            $row = $stmt->fetch();
                            echo "<tr>";
                            echo"<td>".$row['id']."</td>";
                            echo"<td>".$row['productCode']."</td>";
                            echo"<td>$row[2]</td>";
                            echo"<td>".$row['productLine']."</td>";
                            echo"<td>".$row['textDescription']."</td>";
                            echo"<td>".$row['productDescription']."</td>"; 
                            echo"</tr>";
                        }//for
                        echo"</table>";

                    } 

                    $next = $startrow+1;
                    if( $next < 21 ){
                    //now this is the link..
                    echo '<a  href="'.$_SERVER['PHP_SELF'].'?startrow='.($startrow+20).'">Next</a>';
                    }


                    $prev = $startrow - 20;

                    //only print a "Previous" link if a "Next" was clicked
                    if ($prev >= 0)
                        echo '<a  href="'.$_SERVER['PHP_SELF'].'?startrow='.$prev.'">Previous</a>';
                ?>
            </form>
        </div>    
        
        <div  id="vjezbanjeKlase" >
            <?php
 
                class Dog
                { 
                    protected $type;
                    
                    public function setType($newType)
                    {
                        $this->type = $newType;
                    }

                    public function getProperty()
                    {
                        return $this->type;
                    }
                }

                class houseDog extends Dog
                {
                    public $name; 
                    public $weight;
                    
                    public function __construct($newType, $newName, $newWeight)
                    {
                        $this->type = $newType;
                        $this->name = $newName;
                        $this->weight = $newWeight;
                    }
                    
                    public function printAll_data()
                    {
                        $spremiPodatke =  " ". $this->type. "   " . $this->name. "  ". $this->weight;
                        return  $spremiPodatke;
                    } 
                }
                
                $obj = new Dog;
                $obj->setType("House dogs");
                
                $newHouse = new houseDog("house dog, ", "chao chao,","25");
                $newHouse2 = new houseDog("house dog, ", "samojed,","22");
                $newHouse3 = new houseDog("house dog, ", "samojed,","22");
                if( $obj->getProperty() == "House dogs" )
                {
                    echo "Sada cemo vidjeti klase, nasljeđivanje klase, itd. <br/> ". $obj->getProperty()."<br/>" ;
                     
                    echo "First dog:  ". $newHouse->printAll_data() . "<br/>";
                    echo "Second dog:  ". $newHouse2->printAll_data(). "<br/>";
                    echo "Može li klasa koja je naslijedila drugu klasu, vidjeti metode koje se nalaze unutar druge klase:  ". $newHouse3->getProperty(). " Može vidjeti <br/>";
                }

            ?>
            
        </div>
        
        <P style="margin-left: 25%; margin-top: 10%; ">  Primjer gdje kreiram istu tablicu, sa istim podacima, ali malo na drugaciji nacin. </P>
         
        <?php
        
            $sql = "SELECT * FROM products as p "
                    . "   JOIN productslines as pr on p.productLine = pr.id_productLine order by p.id ASC ";
            $stmt = $conn->prepare($sql);
            $is_Query_Good = $stmt->execute();

            if(!$is_Query_Good)
            {
                die("Upit neuspjesan555: ");
            } 
        ?>
        
        <table id="table2" border="2">
            <thead> 
                <td>   id    </td>
                <td>   productCode   </td>
                <td>   productName   </td>
                <td>   productLine    </td>
                <td>   textDescription   </td>
                <td>   productDescription   </td> 
            </thead>
            <tbody> 
            <?php
                while($row = $stmt->fetch()) 
                {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo $row['productCode']; ?>
                        </td>
                        <td>
                            <?php echo $row['productName']; ?>
                        </td>
                        <td>
                            <?php echo $row['productLine']; ?>
                        </td>
                        <td>
                            <?php echo $row['productDescription']; ?>
                        </td>
                        <td>
                            <?php echo $row['textDescription']; ?>
                        </td>
                    </tr>  
                    <?php
                }
        
            ?>
            </tbody> 
        </table>
        
       
        
    </body>
</html>
