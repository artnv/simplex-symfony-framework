<div style="width: 600px;border: 1px dashed black;padding:20px;">
    <h1>Page: View/default.php</h1>
    <p>
        <b>Model data: </b><br>
        <div style="border: 1px dashed gray;padding:20px;">
        
        Default Year: <?php echo htmlspecialchars($year, ENT_QUOTES, 'UTF-8'); ?>
        
        <br/>
        <?php echo $result; ?>
        
        <br/>
        <?php 

            $url = $_urlGenerator->generate(
                'leapYear',
                array('year' => '2017'),
                $_urlGenerator_AbsoluteUrl
            );
        
            echo "<a href=\"$url\">$url</a> ";
        
        ?>
        </div>
    </p>
</div>