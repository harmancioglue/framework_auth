<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">

   <div class="container">
       <a class="navbar-brand" href="<?php echo URL_ROOT; ?>"><? echo SITE_NAME; ?></a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>

       <div class="collapse navbar-collapse" id="navbarsExampleDefault">
           <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                   <a class="nav-link" href="<? echo URL_ROOT; ?>">Home</a>
               </li>
           </ul>


           <ul class="navbar-nav ml-auto">

               <?php if (!SessionUtils::isUserLogin()) { ?>
               <li class="nav-item">
               <a class="nav-link" href="<?php echo URL_ROOT;?>/users/register">Register</a>

               </li>
               <li class="nav-item">
                   <a class="nav-link" href="<?php echo URL_ROOT;?>/users/login">Login</a>
               </li>
               <?php }  ?>

               <?php if (SessionUtils::isUserLogin()) { ?>
                   <li class="nav-item">
                       <a class="nav-link" href="<?php echo URL_ROOT;?>/users/logout">Logout</a>

                   </li>
               <?php }  ?>

           </ul>

       </div>
   </div>

</nav>