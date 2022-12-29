    <!-- Match -->
    <style>
        #match {
            background: url(<?php echo base_url();?>style/assets/img/bg-masthead.jpg) no-repeat center center fixed;
            display: table;
            height: 100%;
            position: relative;
            width: 100%;
            background-size: cover;
            }
    </style>
    <div id="match">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-black">
                        <!-- Page heading-->
                        <h1 class="mb-5">Start playing!</h1>

                        <!-- <form class="form-match" id="contactForm" data-sb-form-api-token="API_TOKEN"> -->
                            <?php echo form_open('page_accueil'); ?>
                            <!-- Email address input-->
                                <div class="row">
                                    <div class="col">
                                        <input class="form-control form-control-lg" type="input" name="mat_code" placeholder="Code match"/>
                                        <div class="text-black"><?php echo validation_errors(); ?></div>
                                    </div>
                                    <div class="col-auto"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">Submit</button></div>
                                </div>

                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- News -->
    <div class="container" style="margin-top: 40px;">
        <div class="row">
            <h2><?php echo $titre;?></h2>
            <?php
                if($news != NULL) {         
                    echo '<table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Titre</th>
                            <th>Description</th>
                            <th>Auteur</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>';
                            foreach($news as $new){
                                echo "<tr>";
                                    echo "<td>".$new["new_titre"]."</td>";
                                    echo "<td>".$new["new_texte"]."</td>";
                                    echo "<td>".$new["usr_pseudo"]."</td>";
                                    echo "<td>".$new["new_date"]."</td>";
                                echo "</tr>";
                            }
                            echo"</tbody>
                        </table>";
                    }
                else {echo "<br />";
                    echo "Aucune actualité pour l'instant !";
                }
            ?>  
        </div>
    </div>    