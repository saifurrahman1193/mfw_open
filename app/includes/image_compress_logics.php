<?php

    if ($imgSize>4000) 
    { 
        $image->scale(10); 
    }
    elseif ($imgSize>3000) 
    { 
        $image->scale(15); 
    }
    elseif ($imgSize>2000) 
    { 
        $image->scale(20); 
    }
    elseif ($imgSize>1500) 
    { 
        $image->scale(35); 
    }
    elseif ($imgSize>1000) 
    { 
        $image->scale(30); 
    }
    elseif ($imgSize>500) 
    { 
        $image->scale(50); 
    }
    elseif ($imgSize>250) 
    { 
        $image->scale(75); 
    }
?>