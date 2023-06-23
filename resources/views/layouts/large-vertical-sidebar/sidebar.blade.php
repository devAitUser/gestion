<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item {{ request()->is('home')  ? 'active' : '' }}  {{ request()->is('/')  ? 'active' : '' }}" >
                <a class="nav-item-hold" href="{{ route('home') }}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <div class="triangle"></div>
            </li>

         

            @can('admin_access_all_page_utilisateurs')
  

            <li class="nav-item "  data-item="utilisateurs">
                <a class="nav-item-hold" href="">
                        <i class=" nav-icon i-Male"></i>
                        <span class="nav-text">Utilisateurs</span>
                    </a>
                    <div class="triangle"></div>
            </li>
            @endcan

  

            <li class="nav-item "  data-item="achats">
                <a class="nav-item-hold" href="">
                        <i class="  nav-icon i-Full-Basket"></i>
                        <span class="nav-text">Achats</span>
                    </a>
                    <div class="triangle"></div>
            </li>


    
              
           
             <li class="nav-item @if (Route::current()->getName() == 'product.edit'  ) active @endif {{ request()->is('projets/create') ? 'active' : '' }} {{ request()->is('projets') ? 'active' : '' }}"  >
                <a class="nav-item-hold" href="{{ url('projets') }}">
                    <i class="nav-icon i-Box-Full"></i>   
                    <span class="nav-text"> Projets</span>
                </a>
                <div class="triangle"></div>
             </li>

             <li class="nav-item {{ request()->is('clients')  ? 'active' : '' }}  {{ request()->is('clients/index')  ? 'active' : '' }}"  >

                <a class="nav-item-hold" href="{{ url('clients')}}">
                    <i class="nav-icon i-Network"></i>
                    <span class="nav-text"> Clients</span>
                </a>
                <div class="triangle"></div>
             </li>

             
             <li class="nav-item {{ request()->is('stocks')  ? 'active' : '' }}  {{ request()->is('stocks/index')  ? 'active' : '' }}"  >

                <a class="nav-item-hold" href="{{ url('stocks')}}">
                    <i class="nav-icon i-Shop-3"></i>
                    <span class="nav-text"> Stocks </span>
                </a>
                <div class="triangle"></div>
             </li>  
             <li  data-item="rh" class="nav-item"  >

                <a class="nav-item-hold" href="{{ url('rh')}}">
                    <i class="nav-icon i-ID-3"></i>
                    <span class="nav-text"> RH </span>
                </a>
                <div class="triangle"></div>
             </li> 
              

     
     
        
          
       
         
        
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu commandes -->
        <ul class="childNav" data-parent="commandes">
            @if ($user_logged->inRole($current_user_name_role)  )
              @if ($user_logged->hasAccess(['order.create']))
            <li class="nav-item ">
                <a class="{{ Route::currentRouteName()=='order/create' ? 'open' : '' }}"
                    href=" ">
                    <i class="nav-icon i-Add-Cart"></i>
                    <span class="item-name">Nouvelle commande</span>
                </a>
            </li>
             @endif
            @endif
            <li class="nav-item">
                <a href=""
                    class="{{ Route::currentRouteName()=='order' ? 'open' : '' }}">
                    <i class="nav-icon i-Checkout"></i>
                    <span class="item-name">liste des commandes</span>
                </a>
            </li>
           
        </ul>

         <!-- Submenu products -->
         <ul class="childNav" data-parent="products">
            <li class="nav-item">
                <a href="{{ url('product') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Shopping-Basket"></i>
                    <span class="nav-text"> Produits du stock</span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('product_site') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Shopping-Basket"></i>
                    <span class="nav-text"> Produits des sites</span>
                </a>
            </li>

            <li class="nav-item ">
                <a class="nav-item {{ Route::currentRouteName()=='gategorie' ? 'open' : '' }}"
                    href="">
                    <i class="nav-icon i-Duplicate-Window"></i>
                    <span class="nav-text">Marque</span>
                </a>
            </li>
        
            <li class="nav-item">
                <a href=""
                    class="{{ Route::currentRouteName()=='modele' ? 'open' : '' }}">
                    <i class="nav-icon i-This-Side-Up"></i>
                    <span class="nav-text">Site</span>
                </a>
            </li>
      
           
        </ul>

        

                <!-- Submenu rh -->
            <ul class="childNav" data-parent="rh">

                    <li class="nav-item">
                        <a href="{{ url('rh')}}"
                            class="{{ Route::currentRouteName()=='permission' ? 'open' : '' }}">
                            <i class="nav-icon i-Receipt-3"></i>
                            <span class="nav-text"> Employés
                            </span>
                            
                        </a>
                    </li> 

                    <li class="nav-item">
                        <a href="{{ url('pointage')}}"
                            class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                            <i class="nav-icon i-Address-Book-2"></i>
                            <span class="nav-text"> Pointages
                            </span>
                            
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('paie_index')}}"
                            class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                            <i class="nav-icon nav-icon i-Financial"></i>
                            <span class="nav-text"> Paie
                            </span>
                            
                        </a>
                    </li>

           

                



      
           
            </ul>


         <!-- Submenu achats -->
         <ul class="childNav" data-parent="achats">
            <li class="nav-item">
                <a href=" {{ url('fournisseur')}}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Address-Book-2"></i>
                    <span class="nav-text"> Fornisseurs
                    </span>
                    
                </a>
            </li>

            <!-- <li class="nav-item">
                <a href="{{ url('facture')}}"
                    class="{{ Route::currentRouteName()=='permission' ? 'open' : '' }}">
                    <i class="nav-icon i-Receipt-3"></i>
                    <span class="nav-text"> Facture
                    </span>
                    
                </a>
            </li> -->

            <li class="nav-item">
                <a href="{{ url('view_all_factures_fournisseur')}}"
                    class="{{ Route::currentRouteName()=='permission' ? 'open' : '' }}">
                    <i class="nav-icon i-Receipt-3"></i>
                    <span class="nav-text"> Tous les Factures des fournisseurs
                    </span>
                    
                </a>
            </li> 



      
           
        </ul>

        <!-- Submenu utilisateurs -->
        <ul class="childNav" data-parent="utilisateurs">
            <li class="nav-item">
                <a href="{{ URL::route('users') }}"
                    class="{{ Route::currentRouteName()=='marque' ? 'open' : '' }}">
                    <i class="nav-icon i-Administrator"></i>
                    <span class="nav-text"> utilisateurs
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('permission') }}"
                    class="{{ Route::currentRouteName()=='permission' ? 'open' : '' }}">
                    <i class="nav-icon i-Share"></i>
                    <span class="nav-text"> Assigner Permission
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('permission_order') }}"
                    class="{{ Route::currentRouteName()=='menu_pages' ? 'open' : '' }}">
                    <i class="nav-icon i-Share"></i>
                    <span class="nav-text"> Permission Commande
                    </span>
                    
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ URL::route('roles.index') }}"
                    class="{{ Route::currentRouteName()=='roles' ? 'open' : '' }}">
                    <i class="nav-icon i-Search-People"></i>
                    <span class="nav-text"> Roles
                    </span>
                    
                </a>
            </li>

      
           
        </ul>

    </div>


    <div class="sidebar-overlay"></div>
</div>
<!--=============== Left side End ================-->