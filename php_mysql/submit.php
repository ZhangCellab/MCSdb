<?php

    if(isset($_POST['email']) and $_POST['email']!= ''){
        $email = $_POST['email'];
    }else{

        echo (
            "<script type='text/javascript'>
                var result = confirm('Please fill the information of email.');
                if(result){
                    window.location.href=\"../submit.html\";
                }
            </script>"
        );
        return false;
    }

        if(isset($_POST['official_symbol1']) and $_POST['official_symbol1']!= ''){
            $name = $_POST['official_symbol1'];
        }else{

            echo (
                "<script type='text/javascript'>
                    var result = confirm('Please fill the information in \ Official Symbol of MCS protein.');
                    if(result){
                        window.location.href=\"../submit.html\";
                    }
                </script>"
            );
            return false;
        }

        if(isset($_POST['celltype1']) and $_POST['celltype1']!= ''){
            $celltype1 = $_POST['celltype1'];
        }else{

            echo (
                "<script type='text/javascript'>
                    var result = confirm('Please fill the information in \ Uniprot ID of MCS protein.');
                    if(result){
                        window.location.href=\"../submit.html\";
                    }
                </script>"
            );
            return false;
        }

        if(isset($_POST['organism']) and $_POST['organism']!= ''){
            $organism = $_POST['organism'];
        }else{

            echo (
                "<script type='text/javascript'>
                    var result = confirm('Please fill the information of organism.');
                    if(result){
                        window.location.href=\"../submit.html\";
                    }
                </script>"
            );
            return false;
        }

        if(isset($_POST['virus']) and $_POST['virus']!= ''){
            $virus = $_POST['virus'];
        }else{

            echo (
                "<script type='text/javascript'>
                    var result = confirm('Please fill the information of Membrane contact sites.');
                    if(result){
                        window.location.href=\"../submit.html\";
                    }
                </script>"
            );
            return false;
        }


    if(isset($_POST['confirm']) and $_POST['confirm']!= ''){
        $confirm = $_POST['confirm'];
    }else{

        echo (
            "<script type='text/javascript'>
                var result = confirm('Please check the \"Confirm you are not a spammer\"');
                if(result){
                    window.location.href=\"../submit.html\";
                }
            </script>"
        );
        return false;
    }


echo (
            "<script type='text/javascript'>
                var result = confirm('Thanks for your submission');
                if(result){
                    window.location.href=\"../submit.html\";
                }
            </script>"
        );


$smarty -> display('../submit.html');

 ?>