<header>
   <nav id="navbar">
      <a href="./" id="logo">Tréteaustore</a>
      <ul class="nav-items">
         <li class="nav-item">
            <a href="#">Produits</a>
         </li>
         <li class="nav-item">
            <a href="#">Panier</a>
         </li>
         <li class="nav-item">
            <a href="#">Mon compte</a>
         </li>
         <li class="nav-item">
            <a href="#">Admin</a>
         </li>
         <li class="nav-item logout">
            <a href="#"><img src="./assets/logout.svg" alt="Icone déconnexion"></a>
         </li>
      </ul>
   </nav>
   <nav id="navbar-admin">
      <ul class="nav-items">
         <li class="nav-item">
            <a href="./?p=clients">Clients</a>
         </li>
         <li class="nav-item">
            <a href="./?p=orders">Commandes</a>
         </li>
      </ul>
   </nav>
</header>

<style>
   header{
      padding: 20px;
   }
   #navbar{
      display: flex;
      justify-content: space-between;
      align-items: center;
   }

   #navbar-admin{
      display: flex;
      justify-content: flex-end;
      align-items: center;
      padding: 20px 0;
   }
   
   #navbar #logo {
      font-weight: 800;
      font-size: 20px;
      font-family: 'Lexend Zetta', sans-serif;
   }

   header .nav-items {
      display: flex;
      gap: 15px;
      align-items: center;
      list-style: none;
   }

   header a{
      text-decoration: none;
      color: white;
   }

   #navbar .logout{
      background: var(--red);
      width: 40px;
      width: 40px;
      height: 40px;
      display: flex;
      justify-content: center;
      align-items: center;
   }
</style>