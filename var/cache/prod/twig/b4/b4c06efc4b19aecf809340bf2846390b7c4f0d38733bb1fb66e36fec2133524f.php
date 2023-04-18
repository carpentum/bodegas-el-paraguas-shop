<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* __string_template__26ffe8ffd517d0410c9ce4fc0cfb0bfa7b5587412b42d12c292ce7085ee0fce0 */
class __TwigTemplate_61bdfd5395eb22cc619fb80e55fd14ddc563d3f57404dba5a71ef33aeb466661 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
            'stylesheets' => [$this, 'block_stylesheets'],
            'extra_stylesheets' => [$this, 'block_extra_stylesheets'],
            'content_header' => [$this, 'block_content_header'],
            'content' => [$this, 'block_content'],
            'content_footer' => [$this, 'block_content_footer'],
            'sidebar_right' => [$this, 'block_sidebar_right'],
            'javascripts' => [$this, 'block_javascripts'],
            'extra_javascripts' => [$this, 'block_extra_javascripts'],
            'translate_javascripts' => [$this, 'block_translate_javascripts'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"es\">
<head>
  <meta charset=\"utf-8\">
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<meta name=\"apple-mobile-web-app-capable\" content=\"yes\">
<meta name=\"robots\" content=\"NOFOLLOW, NOINDEX\">

<link rel=\"icon\" type=\"image/x-icon\" href=\"/img/favicon.ico\" />
<link rel=\"apple-touch-icon\" href=\"/img/app_icon.png\" />

<title>Rendimiento • Bodegas El Paraguas</title>

  <script type=\"text/javascript\">
    var help_class_name = 'AdminPerformance';
    var iso_user = 'es';
    var lang_is_rtl = '0';
    var full_language_code = 'es';
    var full_cldr_language_code = 'es-ES';
    var country_iso_code = 'ES';
    var _PS_VERSION_ = '8.0.2';
    var roundMode = 2;
    var youEditFieldFor = '';
        var new_order_msg = 'Se ha recibido un nuevo pedido en tu tienda.';
    var order_number_msg = 'Número de pedido: ';
    var total_msg = 'Total: ';
    var from_msg = 'Desde: ';
    var see_order_msg = 'Ver este pedido';
    var new_customer_msg = 'Un nuevo cliente se ha registrado en tu tienda.';
    var customer_name_msg = 'Nombre del cliente: ';
    var new_msg = 'Un nuevo mensaje ha sido publicado en tu tienda.';
    var see_msg = 'Leer este mensaje';
    var token = '7b2b57072320328ac4d9b0506b183538';
    var token_admin_orders = tokenAdminOrders = 'ecaf6d2e20a6b77e69c046ccec9affc1';
    var token_admin_customers = 'd752394d9bb8d60b7beed6ea1adf8ad2';
    var token_admin_customer_threads = tokenAdminCustomerThreads = 'e2413bed18871135b16d98d7cfe6677b';
    var currentIndex = 'index.php?controller=AdminPerformance';
    var employee_token = 'd38bcb9c1abdeedd154f6f67627a88f1';
    var choose_language_translate = 'Selecciona el idioma:';
    var default_language = '1';
    var admin_modules_link = '/admin474ux0qz8chb1hhsqw9/index.php/improve/modules/manage?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA';
    var admin_notification_get_link = '/admin474ux0qz8chb1hhsqw9/index.php/common/notifications?_token=pKeqTc0Y-JXys2x4E7";
        // line 42
        echo "GxPfqPN7Y2j0df67IwinThKRA';
    var admin_notification_push_link = adminNotificationPushLink = '/admin474ux0qz8chb1hhsqw9/index.php/common/notifications/ack?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA';
    var tab_modules_list = '';
    var update_success_msg = 'Actualización correcta';
    var search_product_msg = 'Buscar un producto';
  </script>



<link
      rel=\"preload\"
      href=\"/admin474ux0qz8chb1hhsqw9/themes/new-theme/public/703cf8f274fbb265d49c6262825780e1.preload.woff2\"
      as=\"font\"
      crossorigin
    >
      <link href=\"/admin474ux0qz8chb1hhsqw9/themes/new-theme/public/theme.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/chosen/jquery.chosen.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/js/jquery/plugins/fancybox/jquery.fancybox.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/blockwishlist/public/backoffice.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/admin474ux0qz8chb1hhsqw9/themes/default/css/vendor/nv.d3.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/psxmarketingwithgoogle/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
      <link href=\"/modules/ps_facebook/views/css/admin/menu.css\" rel=\"stylesheet\" type=\"text/css\"/>
  
  <script type=\"text/javascript\">
var baseAdminDir = \"\\/admin474ux0qz8chb1hhsqw9\\/\";
var baseDir = \"\\/\";
var changeFormLanguageUrl = \"\\/admin474ux0qz8chb1hhsqw9\\/index.php\\/configure\\/advanced\\/employees\\/change-form-language?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\";
var currency = {\"iso_code\":\"EUR\",\"sign\":\"\\u20ac\",\"name\":\"Euro\",\"format\":null};
var currency_specifications = {\"symbol\":[\",\",\".\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"currencyCode\":\"EUR\",\"currencySymbol\":\"\\u20ac\",\"numberSymbols\":[\",\",\".\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.00\\u00a0\\u00a4\",\"negativePattern\":\"-#,##0.00\\u00a0\\u00a4\",\"maxFractionDigits\":2,\"minFractionDigits\":2,\"gro";
        // line 70
        echo "upingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var number_specifications = {\"symbol\":[\",\",\".\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"numberSymbols\":[\",\",\".\",\";\",\"%\",\"-\",\"+\",\"E\",\"\\u00d7\",\"\\u2030\",\"\\u221e\",\"NaN\"],\"positivePattern\":\"#,##0.###\",\"negativePattern\":\"-#,##0.###\",\"maxFractionDigits\":3,\"minFractionDigits\":0,\"groupingUsed\":true,\"primaryGroupSize\":3,\"secondaryGroupSize\":3};
var prestashop = {\"debug\":false};
var show_new_customers = \"1\";
var show_new_messages = \"1\";
var show_new_orders = \"1\";
</script>
<script type=\"text/javascript\" src=\"/admin474ux0qz8chb1hhsqw9/themes/new-theme/public/main.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/jquery.chosen.js\"></script>
<script type=\"text/javascript\" src=\"/js/jquery/plugins/fancybox/jquery.fancybox.js\"></script>
<script type=\"text/javascript\" src=\"/js/admin.js?v=8.0.2\"></script>
<script type=\"text/javascript\" src=\"/admin474ux0qz8chb1hhsqw9/themes/new-theme/public/cldr.bundle.js\"></script>
<script type=\"text/javascript\" src=\"/js/tools.js?v=8.0.2\"></script>
<script type=\"text/javascript\" src=\"/modules/blockwishlist/public/vendors.js\"></script>
<script type=\"text/javascript\" src=\"/modules/gamification/views/js/gamification_bt.js\"></script>
<script type=\"text/javascript\" src=\"/js/vendor/d3.v3.min.js\"></script>
<script type=\"text/javascript\" src=\"/admin474ux0qz8chb1hhsqw9/themes/default/js/vendor/nv.d3.min.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_emailalerts/js/admin/ps_emailalerts.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_mbo/views/js/recommended-modules.js?v=4.4.0\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_faviconnotificationbo/views/js/favico.js\"></script>
<script type=\"text/javascript\" src=\"/modules/ps_faviconnotificationbo/views/js/ps_faviconnotificationbo.js\"></script>

  <script>
            var admin_gamification_ajax_url = \"http:\\/\\/prestashop.local\\/admin474ux0qz8chb1hhsqw9\\/index.php?controller=A";
        // line 93
        echo "dminGamification&token=f0c354ee09d6b34fb763799f04a0e51b\";
            var current_id_tab = 94;
        </script><script>
  if (undefined !== ps_faviconnotificationbo) {
    ps_faviconnotificationbo.initialize({
      backgroundColor: '#DF0067',
      textColor: '#FFFFFF',
      notificationGetUrl: '/admin474ux0qz8chb1hhsqw9/index.php/common/notifications?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA',
      CHECKBOX_ORDER: 1,
      CHECKBOX_CUSTOMER: 1,
      CHECKBOX_MESSAGE: 1,
      timer: 120000, // Refresh every 2 minutes
    });
  }
</script>


";
        // line 110
        $this->displayBlock('stylesheets', $context, $blocks);
        $this->displayBlock('extra_stylesheets', $context, $blocks);
        echo "</head>";
        echo "

<body
  class=\"lang-es adminperformance\"
  data-base-url=\"/admin474ux0qz8chb1hhsqw9/index.php\"  data-token=\"pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\">

  <header id=\"header\" class=\"d-print-none\">

    <nav id=\"header_infos\" class=\"main-header\">
      <button class=\"btn btn-primary-reverse onclick btn-lg unbind ajax-spinner\"></button>

            <i class=\"material-icons js-mobile-menu\">menu</i>
      <a id=\"header_logo\" class=\"logo float-left\" href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminDashboard&amp;token=4f41a90886778a62342f3f5479c22839\"></a>
      <span id=\"shop_version\">8.0.2</span>

      <div class=\"component\" id=\"quick-access-container\">
        <div class=\"dropdown quick-accesses\">
  <button class=\"btn btn-link btn-sm dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\" id=\"quick_select\">
    Acceso rápido
  </button>
  <div class=\"dropdown-menu\">
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=d141fe51feeff153c8c4dddbcff96aec\"
                 data-item=\"Evaluación del catálogo\"
      >Evaluación del catálogo</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/improve/modules/manage?token=99f4853bccf7c1960f6b319fb0a29192\"
                 data-item=\"Módulos instalados\"
      >Módulos instalados</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/categories/new?token=99f4853bccf7c1960f6b319fb0a29192\"
                 data-item=\"Nueva categoría\"
      >Nueva categoría</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/products/new?token=99f4853bccf7c1960f6b319fb0a29192\"
               ";
        // line 145
        echo "  data-item=\"Nuevo\"
      >Nuevo</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=f978ae5e043b7fbcda8df44d5cb85235\"
                 data-item=\"Nuevo cupón de descuento\"
      >Nuevo cupón de descuento</a>
          <a class=\"dropdown-item quick-row-link\"
         href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/orders?token=99f4853bccf7c1960f6b319fb0a29192\"
                 data-item=\"Pedidos\"
      >Pedidos</a>
        <div class=\"dropdown-divider\"></div>
          <a id=\"quick-add-link\"
        class=\"dropdown-item js-quick-link\"
        href=\"#\"
        data-rand=\"193\"
        data-icon=\"icon-AdminAdvancedParameters\"
        data-method=\"add\"
        data-url=\"index.php/configure/advanced/performance/?-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"
        data-post-link=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminQuickAccesses&token=6d1930e6aeea26e3cd862d11cc62eb10\"
        data-prompt-text=\"Por favor, renombre este acceso rápido:\"
        data-link=\"Rendimiento - Lista\"
      >
        <i class=\"material-icons\">add_circle</i>
        Añadir página actual al Acceso Rápido
      </a>
        <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminQuickAccesses&token=6d1930e6aeea26e3cd862d11cc62eb10\">
      <i class=\"material-icons\">settings</i>
      Administrar accesos rápidos
    </a>
  </div>
</div>
      </div>
      <div class=\"component component-search\" id=\"header-search-container\">
        <div class=\"component-search-body\">
          <div class=\"component-search-top\">
            <form id=\"header_search\"
      class=\"bo_search_form dropdown-form js-dropdown-form collapsed\"
      method=\"post\"
      action=\"/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminSearch&amp;token=508179ae8ac27c3e616791d7de629c";
        // line 183
        echo "ec\"
      role=\"search\">
  <input type=\"hidden\" name=\"bo_search_type\" id=\"bo_search_type\" class=\"js-search-type\" />
    <div class=\"input-group\">
    <input type=\"text\" class=\"form-control js-form-search\" id=\"bo_query\" name=\"bo_query\" value=\"\" placeholder=\"Buscar (p. ej.: referencia de producto, nombre de cliente...)\" aria-label=\"Barra de búsqueda\">
    <div class=\"input-group-append\">
      <button type=\"button\" class=\"btn btn-outline-secondary dropdown-toggle js-dropdown-toggle\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
        toda la tienda
      </button>
      <div class=\"dropdown-menu js-items-list\">
        <a class=\"dropdown-item\" data-item=\"toda la tienda\" href=\"#\" data-value=\"0\" data-placeholder=\"¿Qué estás buscando?\" data-icon=\"icon-search\"><i class=\"material-icons\">search</i> toda la tienda</a>
        <div class=\"dropdown-divider\"></div>
        <a class=\"dropdown-item\" data-item=\"Catálogo\" href=\"#\" data-value=\"1\" data-placeholder=\"Nombre del producto, referencia, etc.\" data-icon=\"icon-book\"><i class=\"material-icons\">store_mall_directory</i> Catálogo</a>
        <a class=\"dropdown-item\" data-item=\"Clientes por nombre\" href=\"#\" data-value=\"2\" data-placeholder=\"Nombre\" data-icon=\"icon-group\"><i class=\"material-icons\">group</i> Clientes por nombre</a>
        <a class=\"dropdown-item\" data-item=\"Clientes por dirección IP\" href=\"#\" data-value=\"6\" data-placeholder=\"123.45.67.89\" data-icon=\"icon-desktop\"><i class=\"material-icons\">desktop_mac</i> Clientes por dirección IP</a>
        <a class=\"dropdown-item\" data-item=\"Pedidos\" href=\"#\" data-value=\"3\" data-placeholder=\"ID del pedido\" data-icon=\"icon-credit-card\"><i class=\"material-icons\">shopping_basket</i> Pedidos</a>
        <a class=\"dropdown-item\" data-item=\"Facturas\" href=\"#\" data-value=\"4\" data-placeholder=\"Numero de Factura\" data-icon=\"icon-book\"><i class=\"material-icons\">book</i> Facturas</a>
        <a class=\"dropdown-item\" data-item=\"Carritos\" href=\"#\" data-value=\"5\" ";
        // line 200
        echo "data-placeholder=\"ID carrito\" data-icon=\"icon-shopping-cart\"><i class=\"material-icons\">shopping_cart</i> Carritos</a>
        <a class=\"dropdown-item\" data-item=\"Módulos\" href=\"#\" data-value=\"7\" data-placeholder=\"Nombre del módulo\" data-icon=\"icon-puzzle-piece\"><i class=\"material-icons\">extension</i> Módulos</a>
      </div>
      <button class=\"btn btn-primary\" type=\"submit\"><span class=\"d-none\">BÚSQUEDA</span><i class=\"material-icons\">search</i></button>
    </div>
  </div>
</form>

<script type=\"text/javascript\">
 \$(document).ready(function(){
    \$('#bo_query').one('click', function() {
    \$(this).closest('form').removeClass('collapsed');
  });
});
</script>
            <button class=\"component-search-cancel d-none\">Cancelar</button>
          </div>

          <div class=\"component-search-quickaccess d-none\">
  <p class=\"component-search-title\">Acceso rápido</p>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminStats&amp;module=statscheckup&amp;token=d141fe51feeff153c8c4dddbcff96aec\"
             data-item=\"Evaluación del catálogo\"
    >Evaluación del catálogo</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/improve/modules/manage?token=99f4853bccf7c1960f6b319fb0a29192\"
             data-item=\"Módulos instalados\"
    >Módulos instalados</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/categories/new?token=99f4853bccf7c1960f6b319fb0a29192\"
             data-item=\"Nueva categoría\"
    >Nueva categoría</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/products/new?token=99f4853bccf7c1960f6b319fb0a29192\"
             data-item=\"Nuevo\"
    >Nuevo</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.loca";
        // line 237
        echo "l/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCartRules&amp;addcart_rule&amp;token=f978ae5e043b7fbcda8df44d5cb85235\"
             data-item=\"Nuevo cupón de descuento\"
    >Nuevo cupón de descuento</a>
      <a class=\"dropdown-item quick-row-link\"
       href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php/sell/orders?token=99f4853bccf7c1960f6b319fb0a29192\"
             data-item=\"Pedidos\"
    >Pedidos</a>
    <div class=\"dropdown-divider\"></div>
      <a id=\"quick-add-link\"
      class=\"dropdown-item js-quick-link\"
      href=\"#\"
      data-rand=\"150\"
      data-icon=\"icon-AdminAdvancedParameters\"
      data-method=\"add\"
      data-url=\"index.php/configure/advanced/performance/?-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"
      data-post-link=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminQuickAccesses&token=6d1930e6aeea26e3cd862d11cc62eb10\"
      data-prompt-text=\"Por favor, renombre este acceso rápido:\"
      data-link=\"Rendimiento - Lista\"
    >
      <i class=\"material-icons\">add_circle</i>
      Añadir página actual al Acceso Rápido
    </a>
    <a id=\"quick-manage-link\" class=\"dropdown-item\" href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminQuickAccesses&token=6d1930e6aeea26e3cd862d11cc62eb10\">
    <i class=\"material-icons\">settings</i>
    Administrar accesos rápidos
  </a>
</div>
        </div>

        <div class=\"component-search-background d-none\"></div>
      </div>

      
      
      <div class=\"header-right\">
                  <div class=\"component\" id=\"header-shop-list-container\">
              <div class=\"shop-list\">
    <a class=\"link\" id=\"header_shopname\" href=\"http://prestashop.local/\" target= \"_blank\">
      <i class=\"material-icons\">visibility</i>
      <span>Ver mi tienda</span>
    </a>
  </div>
          </div>
                          <div class=\"component header-right-component\" id=\"header-notifications-container\">
            <div id=\"notif\" class=\"notificatio";
        // line 281
        echo "n-center dropdown dropdown-clickable\">
  <button class=\"btn notification js-notification dropdown-toggle\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">notifications_none</i>
    <span id=\"notifications-total\" class=\"count hide\">0</span>
  </button>
  <div class=\"dropdown-menu dropdown-menu-right js-notifs_dropdown\">
    <div class=\"notifications\">
      <ul class=\"nav nav-tabs\" role=\"tablist\">
                          <li class=\"nav-item\">
            <a
              class=\"nav-link active\"
              id=\"orders-tab\"
              data-toggle=\"tab\"
              data-type=\"order\"
              href=\"#orders-notifications\"
              role=\"tab\"
            >
              Pedidos<span id=\"_nb_new_orders_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"customers-tab\"
              data-toggle=\"tab\"
              data-type=\"customer\"
              href=\"#customers-notifications\"
              role=\"tab\"
            >
              Clientes<span id=\"_nb_new_customers_\"></span>
            </a>
          </li>
                                    <li class=\"nav-item\">
            <a
              class=\"nav-link \"
              id=\"messages-tab\"
              data-toggle=\"tab\"
              data-type=\"customer_message\"
              href=\"#messages-notifications\"
              role=\"tab\"
            >
              Mensajes<span id=\"_nb_new_messages_\"></span>
            </a>
          </li>
                        </ul>

      <!-- Tab panes -->
      <div class=\"tab-content\">
                          <div class=\"tab-pane active empty\" id=\"orders-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No hay pedidos nuevos por ahora :(<br>
              ¿Has revisado tus &lt;strong&gt;&lt;a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCarts&amp;action=filterOnlyAbandonedCa";
        // line 332
        echo "rts&amp;token=f243760d739a8a6e21958fd7914df8fc\"&gt;carritos abandonados&lt;/a&gt;&lt;/strong&gt;?&lt;br&gt;?. ¡Tu próximo pedido podría estar ocultándose allí!
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"customers-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No hay clientes nuevos por ahora :(<br>
              ¿Se mantiene activo en las redes sociales en estos momentos?
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                                    <div class=\"tab-pane  empty\" id=\"messages-notifications\" role=\"tabpanel\">
            <p class=\"no-notification\">
              No hay mensajes nuevo por ahora.<br>
              Parece que todos tus clientes están contentos :)
            </p>
            <div class=\"notification-elements\"></div>
          </div>
                        </div>
    </div>
  </div>
</div>

  <script type=\"text/html\" id=\"order-notification-template\">
    <a class=\"notif\" href='order_url'>
      #_id_order_ -
      de <strong>_customer_name_</strong> (_iso_code_)_carrier_
      <strong class=\"float-sm-right\">_total_paid_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"customer-notification-template\">
    <a class=\"notif\" href='customer_url'>
      #_id_customer_ - <strong>_customer_name_</strong>_company_ - registrado <strong>_date_add_</strong>
    </a>
  </script>

  <script type=\"text/html\" id=\"message-notification-template\">
    <a class=\"notif\" href='message_url'>
    <span class=\"message-notification-status _status_\">
      <i class=\"material-icons\">fiber_manual_record</i> _status_
    </span>
      - <strong>_customer_name_</strong> (_company_) - <i class=\"material-icons\">access_time</i> _date_add_
    </a>
  </script>
          </div>
        
        <div class=\"component\" id=\"header-employee-container\">
          <d";
        // line 380
        echo "iv class=\"dropdown employee-dropdown\">
  <div class=\"rounded-circle person\" data-toggle=\"dropdown\">
    <i class=\"material-icons\">account_circle</i>
  </div>
  <div class=\"dropdown-menu dropdown-menu-right\">
    <div class=\"employee-wrapper-avatar\">
      <div class=\"employee-top\">
        <span class=\"employee-avatar\"><img class=\"avatar rounded-circle\" src=\"http://prestashop.local/img/pr/default.jpg\" alt=\"Marcial\" /></span>
        <span class=\"employee_profile\">Bienvenido de nuevo, Marcial</span>
      </div>

      <a class=\"dropdown-item employee-link profile-link\" href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/employees/1/edit?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\">
      <i class=\"material-icons\">edit</i>
      <span>Tu perfil</span>
    </a>
    </div>

    <p class=\"divider\"></p>

                  <a class=\"dropdown-item \" href=\"https://accounts.distribution.prestashop.net?utm_source=prestashop.local&utm_medium=back-office&utm_campaign=ps_accounts&utm_content=headeremployeedropdownlink\" target=\"_blank\" rel=\"noopener noreferrer nofollow\">
            <i class=\"material-icons\">open_in_new</i> Gestione tu cuenta PrestaShop
        </a>
                  <p class=\"divider\"></p>
            
    <a class=\"dropdown-item employee-link text-center\" id=\"header_logout\" href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminLogin&amp;logout=1&amp;token=97097e6f35e6047befea6226460505b0\">
      <i class=\"material-icons d-lg-none\">power_settings_new</i>
      <span>Cerrar sesión</span>
    </a>
  </div>
</div>
        </div>
              </div>
    </nav>
  </header>

  <nav class=\"nav-bar d-none d-print-none d-md-block\">
  <span class=\"menu-collapse\" data-toggle-url=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/employees/toggle-navigation?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\">
    <i class=\"material-icons rtl-flip\">chevron_left</i>
    <i class=\"material-icons rtl-flip\">chevron_left</i>
  </s";
        // line 419
        echo "pan>

  <div class=\"nav-bar-overflow\">
      <div class=\"logo-container\">
          <a id=\"header_logo\" class=\"logo float-left\" href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminDashboard&amp;token=4f41a90886778a62342f3f5479c22839\"></a>
          <span id=\"shop_version\" class=\"header-version\">8.0.2</span>
      </div>

      <ul class=\"main-menu\">
              
                    
                    
          
            <li class=\"link-levelone\" data-submenu=\"1\" id=\"tab-AdminDashboard\">
              <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminDashboard&amp;token=4f41a90886778a62342f3f5479c22839\" class=\"link\" >
                <i class=\"material-icons\">trending_up</i> <span>Inicio</span>
              </a>
            </li>

          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"2\" id=\"tab-SELL\">
                <span class=\"title\">Vender</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"3\" id=\"subtab-AdminParentOrders\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/orders/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-shopping_basket\">shopping_basket</i>
                      <span>
                      Pedidos
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-3\" class=\"submenu panel-collapse";
        // line 461
        echo "\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"4\" id=\"subtab-AdminOrders\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/orders/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Pedidos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"5\" id=\"subtab-AdminInvoices\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/orders/invoices/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Facturas
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"6\" id=\"subtab-AdminSlip\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/orders/credit-slips/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Facturas por abono
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"7\" id=\"subtab-AdminDeliverySlip\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/orders/delivery-slips/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Albarane";
        // line 490
        echo "s de entrega
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"8\" id=\"subtab-AdminCarts\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCarts&amp;token=f243760d739a8a6e21958fd7914df8fc\" class=\"link\"> Carritos de compra
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"9\" id=\"subtab-AdminCatalog\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/products?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-store\">store</i>
                      <span>
                      Catálogo
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-9\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"10\" id=\"subtab-AdminProducts\">
                                <a href=\"/admi";
        // line 523
        echo "n474ux0qz8chb1hhsqw9/index.php/sell/catalog/products?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Productos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"11\" id=\"subtab-AdminCategories\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/categories?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Categorías
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"12\" id=\"subtab-AdminTracking\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/monitoring/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Monitoreo
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"13\" id=\"subtab-AdminParentAttributesGroups\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminAttributesGroups&amp;token=66d92d4440f8bd7b08edf31d2729740e\" class=\"link\"> Atributos y Características
                                </a>
                              </li>

                                                                                  
                              
                                        ";
        // line 553
        echo "                    
                              <li class=\"link-leveltwo\" data-submenu=\"16\" id=\"subtab-AdminParentManufacturers\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/catalog/brands/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Marcas y Proveedores
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"19\" id=\"subtab-AdminAttachments\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/attachments/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Archivos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"20\" id=\"subtab-AdminParentCartRules\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCartRules&amp;token=f978ae5e043b7fbcda8df44d5cb85235\" class=\"link\"> Descuentos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"23\" id=\"subtab-AdminStockManagement\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/stocks/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Stock
                                </a>
                              </li>

              ";
        // line 583
        echo "                                                                </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"24\" id=\"subtab-AdminParentCustomer\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/customers/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-account_circle\">account_circle</i>
                      <span>
                      Clientes
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-24\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"25\" id=\"subtab-AdminCustomers\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/customers/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Clientes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"26\" id=\"subtab-AdminAddresses\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/addresses/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"";
        // line 612
        echo "link\"> Direcciones
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"28\" id=\"subtab-AdminParentCustomerThreads\">
                    <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCustomerThreads&amp;token=e2413bed18871135b16d98d7cfe6677b\" class=\"link\">
                      <i class=\"material-icons mi-chat\">chat</i>
                      <span>
                      Servicio al Cliente
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-28\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"29\" id=\"subtab-AdminCustomerThreads\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCustomerThreads&amp;token=e2413bed18871135b16d98d7cfe6677b\" class=\"link\"> Servicio al Cliente
                                </a>
                              </li>

                                                                                  
                              
                                                            
                ";
        // line 644
        echo "              <li class=\"link-leveltwo\" data-submenu=\"30\" id=\"subtab-AdminOrderMessage\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/sell/customer-service/order-messages/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Mensajes de Pedidos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"31\" id=\"subtab-AdminReturn\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminReturn&amp;token=8102f47041a47b4ac325fd8d5069152a\" class=\"link\"> Devoluciones de mercancía
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"32\" id=\"subtab-AdminStats\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/metrics/legacy/stats?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-assessment\">assessment</i>
                      <span>
                      Estadísticas
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-32\" class=\"submenu pa";
        // line 673
        echo "nel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"149\" id=\"subtab-AdminMetricsLegacyStatsController\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/metrics/legacy/stats?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Estadísticas
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"150\" id=\"subtab-AdminMetricsController\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/metrics?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> PrestaShop Metrics
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title\" data-submenu=\"37\" id=\"tab-IMPROVE\">
                <span class=\"title\">Personalizar</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"38\" id=\"subtab-AdminParentModulesSf\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/mbo/modules/catalog/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-extension\">extension</i>
                      <span>
  ";
        // line 710
        echo "                    Módulos
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-38\" class=\"submenu panel-collapse\">
                                                                                                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"142\" id=\"subtab-AdminPsMboModuleParent\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/mbo/modules/catalog/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Marketplace
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"39\" id=\"subtab-AdminModulesSf\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/modules/manage?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Administrador de módulos
                                </a>
                              </li>

                                                                                                                                    </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\"";
        // line 739
        echo " data-submenu=\"43\" id=\"subtab-AdminParentThemes\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/design/themes/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-desktop_mac\">desktop_mac</i>
                      <span>
                      Diseño
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-43\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"151\" id=\"subtab-AdminThemesParent\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/design/themes/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Tema y logotipo
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"146\" id=\"subtab-AdminPsMboTheme\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/mbo/themes/catalog/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Catalogue de thèmes
                                </a>
                              </li>

                                                                                  
                              
                                                            
    ";
        // line 769
        echo "                          <li class=\"link-leveltwo\" data-submenu=\"45\" id=\"subtab-AdminParentMailTheme\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/design/mail_theme/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Tema Email
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"47\" id=\"subtab-AdminCmsContent\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/design/cms-pages/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Páginas
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"48\" id=\"subtab-AdminModulesPositions\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/design/modules/positions/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Posiciones
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"49\" id=\"subtab-AdminImages\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminImages&amp;token=b036e46fd15b860f4481b9cfcf449009\" class=\"link\"> Ajustes de imágenes
                                </a>
                              </li>

               ";
        // line 798
        echo "                                                                   
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"117\" id=\"subtab-AdminLinkWidget\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/link-widget/list?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Lista de enlaces
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"50\" id=\"subtab-AdminParentShipping\">
                    <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminCarriers&amp;token=40c549df28d2d5c93b5e68d6bf3e18a7\" class=\"link\">
                      <i class=\"material-icons mi-local_shipping\">local_shipping</i>
                      <span>
                      Transporte
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-50\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"51\" id=\"subtab-AdminCarriers\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controlle";
        // line 827
        echo "r=AdminCarriers&amp;token=40c549df28d2d5c93b5e68d6bf3e18a7\" class=\"link\"> Transportistas
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"52\" id=\"subtab-AdminShipping\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/shipping/preferences/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Preferencias
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"126\" id=\"subtab-AdminMbeShipping\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminMbeShipping&amp;token=f494274423e1e6e44d514e7a2a439881\" class=\"link\"> Listado de envíos MBE
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"53\" id=\"subtab-AdminParentPayment\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/payment/payment_methods?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-payment\">payment</i>
                      <span>
                      Pago
                      </span>
                                          ";
        // line 859
        echo "          <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-53\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"54\" id=\"subtab-AdminPayment\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/payment/payment_methods?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Métodos de pago
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"55\" id=\"subtab-AdminPaymentPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/payment/preferences?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Preferencias
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"56\" id=\"subtab-AdminInternational\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/international/localization/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons ";
        // line 888
        echo "mi-language\">language</i>
                      <span>
                      Internacional
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-56\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"57\" id=\"subtab-AdminParentLocalization\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/international/localization/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Localización
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"62\" id=\"subtab-AdminParentCountries\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/international/zones/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Ubicaciones Geográficas
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"66\" id=\"subtab-AdminParentTaxes\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/international/taxes/?_token=pKeqTc0Y-JXys";
        // line 917
        echo "2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Impuestos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"69\" id=\"subtab-AdminTranslations\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/improve/international/translations/settings?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Traducciones
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"130\" id=\"subtab-Marketing\">
                    <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=a88781ad79b7f611dcb6f59fcf1ec1d4\" class=\"link\">
                      <i class=\"material-icons mi-campaign\">campaign</i>
                      <span>
                      Marketing
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-130\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\"";
        // line 949
        echo " data-submenu=\"131\" id=\"subtab-AdminPsxMktgWithGoogleModule\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminPsxMktgWithGoogleModule&amp;token=a88781ad79b7f611dcb6f59fcf1ec1d4\" class=\"link\"> Google
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"139\" id=\"subtab-AdminPsfacebookModule\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminPsfacebookModule&amp;token=46c51d588fefaf236cd48874b576cc5d\" class=\"link\"> Facebook
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                      
                                          
                    
          
            <li class=\"category-title link-active\" data-submenu=\"70\" id=\"tab-CONFIGURE\">
                <span class=\"title\">Configurar</span>
            </li>

                              
                  
                                                      
                  
                  <li class=\"link-levelone has_submenu\" data-submenu=\"71\" id=\"subtab-ShopParameters\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/preferences/preferences?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-settings\">settings</i>
                      <span>
                      Parámetros de la tienda
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">";
        // line 984
        echo "
                                                                    keyboard_arrow_down
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-71\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"72\" id=\"subtab-AdminParentPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/preferences/preferences?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Configuración
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"75\" id=\"subtab-AdminParentOrderPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/order-preferences/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Configuración de pedidos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"78\" id=\"subtab-AdminPPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/product-preferences/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Configuración de productos
                                </a>
                              </li>

                                          ";
        // line 1013
        echo "                                        
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"79\" id=\"subtab-AdminParentCustomerPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/customer-preferences/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Configuración de clientes
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"83\" id=\"subtab-AdminParentStores\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/contacts/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Contacto
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"86\" id=\"subtab-AdminParentMeta\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/shop/seo-urls/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Tráfico &amp; SEO
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"89\" id=\"subtab-AdminParentSearchConf\">
                                <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=Adm";
        // line 1041
        echo "inSearchConf&amp;token=7bab923bb7ca6d4407564a8f04293f5c\" class=\"link\"> Buscar
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                                              
                  
                                                      
                                                          
                  <li class=\"link-levelone has_submenu link-active open ul-open\" data-submenu=\"92\" id=\"subtab-AdminAdvancedParameters\">
                    <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/system-information/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\">
                      <i class=\"material-icons mi-settings_applications\">settings_applications</i>
                      <span>
                      Parámetros Avanzados
                      </span>
                                                    <i class=\"material-icons sub-tabs-arrow\">
                                                                    keyboard_arrow_up
                                                            </i>
                                            </a>
                                              <ul id=\"collapse-92\" class=\"submenu panel-collapse\">
                                                      
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"93\" id=\"subtab-AdminInformation\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/system-information/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Información
                                </a>
                              </li>

                                                                                  
                              
   ";
        // line 1072
        echo "                                                         
                              <li class=\"link-leveltwo link-active\" data-submenu=\"94\" id=\"subtab-AdminPerformance\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/performance/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Rendimiento
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"95\" id=\"subtab-AdminAdminPreferences\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/administration/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Administración
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"96\" id=\"subtab-AdminEmails\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/emails/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> E-mail
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"97\" id=\"subtab-AdminImport\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/import/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Importar
                                </a";
        // line 1099
        echo ">
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"98\" id=\"subtab-AdminParentEmployees\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/employees/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Equipo
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"102\" id=\"subtab-AdminParentRequestSql\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/sql-requests/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Base de datos
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"105\" id=\"subtab-AdminLogs\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/logs/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Registro de logs
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"106\" id=\"subtab-AdminWebservice\">
                                <a href=\"/admin474ux0qz8chb1hhsq";
        // line 1130
        echo "w9/index.php/configure/advanced/webservice-keys/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Webservice
                                </a>
                              </li>

                                                                                                                                                                                              
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"109\" id=\"subtab-AdminFeatureFlag\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/feature-flags/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Características nuevas y experimentales
                                </a>
                              </li>

                                                                                  
                              
                                                            
                              <li class=\"link-leveltwo\" data-submenu=\"110\" id=\"subtab-AdminParentSecurity\">
                                <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/security/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" class=\"link\"> Seguridad
                                </a>
                              </li>

                                                                              </ul>
                                        </li>
                              
          
                  </ul>
  </div>
  
</nav>


<div class=\"header-toolbar d-print-none\">
    
  <div class=\"container-fluid\">

    
      <nav aria-label=\"Breadcrumb\">
        <ol class=\"breadcrumb\">
                      <li class=\"breadcrumb-item\">Parámetros Avanzados</li>
          
                      <li class=\"breadcrumb-item active\">
              <a href=\"/admin474ux0qz8chb1hhsqw9/index.php/config";
        // line 1170
        echo "ure/advanced/performance/?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" aria-current=\"page\">Rendimiento</a>
            </li>
                  </ol>
      </nav>
    

    <div class=\"title-row\">
      
          <h1 class=\"title\">
            Rendimiento          </h1>
      

      
        <div class=\"toolbar-icons\">
          <div class=\"wrapper\">
            
                                                          <a
                  class=\"btn btn-primary pointer\"                  id=\"page-header-desc-configuration-clear_cache\"
                  href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/performance/clear-cache?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"                  title=\"Borrar la caché\"                >
                  <i class=\"material-icons\">delete</i>                  Borrar la caché
                </a>
                                      
            
                              <a class=\"btn btn-outline-secondary btn-help btn-sidebar\" href=\"#\"
                   title=\"Ayuda\"
                   data-toggle=\"sidebar\"
                   data-target=\"#right-sidebar\"
                   data-url=\"/admin474ux0qz8chb1hhsqw9/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop-project.org%252Fes%252Fdoc%252FAdminAdvancedParametersPerformance%253Fversion%253D8.0.2%2526country%253Des/Ayuda?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"
                   id=\"product_form_open_help\"
                >
                  Ayuda
                </a>
                                    </div>
        </div>

      
    </div>
  </div>

  
  
  <div class=\"btn-floating\">
    <button class=\"btn btn-primary collapsed\" data-toggle=\"collapse\" data-target=\".btn-floating-container\" aria-expanded=\"false\">
      <i class=\"material-icons\">add</i>
    </button>
    <div class=\"btn-floating-container collapse\">
      <div class=\"btn-floating-menu\">
        
                              <a
              class=\"btn btn";
        // line 1219
        echo "-floating-item   pointer\"              id=\"page-header-desc-floating-configuration-clear_cache\"
              href=\"/admin474ux0qz8chb1hhsqw9/index.php/configure/advanced/performance/clear-cache?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"              title=\"Borrar la caché\"            >
              Borrar la caché
              <i class=\"material-icons\">delete</i>            </a>
                  
                              <a class=\"btn btn-floating-item btn-help btn-sidebar\" href=\"#\"
               title=\"Ayuda\"
               data-toggle=\"sidebar\"
               data-target=\"#right-sidebar\"
               data-url=\"/admin474ux0qz8chb1hhsqw9/index.php/common/sidebar/https%253A%252F%252Fhelp.prestashop-project.org%252Fes%252Fdoc%252FAdminAdvancedParametersPerformance%253Fversion%253D8.0.2%2526country%253Des/Ayuda?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"
            >
              Ayuda
            </a>
                        </div>
    </div>
  </div>
  
</div>

<div id=\"main-div\">
          
      <div class=\"content-div  \">

        

                                                        
        <div id=\"ajax_confirmation\" class=\"alert alert-success\" style=\"display: none;\"></div>
<div id=\"content-message-box\"></div>


  ";
        // line 1249
        $this->displayBlock('content_header', $context, $blocks);
        $this->displayBlock('content', $context, $blocks);
        $this->displayBlock('content_footer', $context, $blocks);
        $this->displayBlock('sidebar_right', $context, $blocks);
        echo "

        

      </div>
    </div>

  <div id=\"non-responsive\" class=\"js-non-responsive\">
  <h1>¡Oh no!</h1>
  <p class=\"mt-3\">
    La versión para móviles de esta página no está disponible todavía.
  </p>
  <p class=\"mt-2\">
    Por favor, utiliza un ordenador de escritorio hasta que esta página sea adaptada para dispositivos móviles.
  </p>
  <p class=\"mt-2\">
    Gracias.
  </p>
  <a href=\"http://prestashop.local/admin474ux0qz8chb1hhsqw9/index.php?controller=AdminDashboard&amp;token=4f41a90886778a62342f3f5479c22839\" class=\"btn btn-primary py-1 mt-3\">
    <i class=\"material-icons rtl-flip\">arrow_back</i>
    Atrás
  </a>
</div>
  <div class=\"mobile-layer\"></div>

      <div id=\"footer\" class=\"bootstrap\">
    <div id=\"module-modal-addons-connect\" class=\"modal  modal-vcenter fade\" role=\"dialog\" tabindex=\"-1\" aria-labelledby=\"module-modal-title\" aria-hidden=\"true\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">Conectarse a Addons Marketplace</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
                  <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                      Vincula tu tienda a tu cuenta de Addons para recibir automáticamente actualizaciones importantes de los módulos que hayas adquirido. ¿Aún no tiene una cuenta?
                      <a href=\"https://accounts.distribution.prestashop.net/es/sign-up?_ga=2.183749797.2029715227.1645605306-2047387021.1643627469&amp;_gac=1.81371877.1644238612.CjwKCAiAo4OQBhBBEiwA5KWu_5UzrywbBPo4PKIYESy7K-noavdo7Z4riOZMJEoM9mE1IE3gks0thxoCZOwQAvD_BwE\" target=\"_blank\">Regístrate ahora</a>
                  </p>
                  <p>
                      Si has creado tu cuenta utilizando Google, sigue el procedimiento de contraseña olvidada de Addons Marketplace para crear t";
        // line 1291
        echo "u contraseña : 
                      <a href=\"https://auth.prestashop.com/es/contrasena/solicitud\" target=\"_blank\">Restablecer contraseña</a>
                  </p>
                  <form id=\"addons-connect-form\"
                        action=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/mbo/addons/login?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\"
                        method=\"POST\"
                        data-error-message=\"An error occurred while processing your request.\"
                  >
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-email\">Dirección de correo electrónico</label>
                    <input name=\"username_addons\" type=\"email\" class=\"form-control\" id=\"module-addons-connect-email\" placeholder=\"Email\">
                  </div>
                  <div class=\"form-group\">
                    <label for=\"module-addons-connect-password\">Contraseña</label>
                    <input name=\"password_addons\" type=\"password\" class=\"form-control\" id=\"module-addons-connect-password\" placeholder=\"Password\">
                  </div>
                  <div class=\"md-checkbox md-checkbox-inline\">
                    <label>
                      <input type=\"checkbox\" name=\"addons_remember_me\">
                      <i class=\"md-checkbox-control\"></i>
                        Recordar datos
                    </label>
                  </div>
                  <div class=\"text-center\">
                      <button type=\"submit\" class=\"btn btn-primary\">¡Vamos!</button>
                    <div id=\"addons_login_btn\" class=\"spinner\" style=\"display:none;\"></div>
                  </div>
                </form>
                <p class=\"text-center py-3\">
                    <a href=\"https://auth.prestashop.com/es/contrasena/solicitud\" target=\"_blank\">¿Olvidó su contraseña?</a>
                </p>
              </div>
          </div>
              </div>
    </div>
  </div>
</div>
<div id=\"modu";
        // line 1328
        echo "le-modal-addons-logout\" class=\"modal  modal-vcenter fade\" role=\"dialog\">
  <div class=\"modal-dialog\">
    <!-- Modal content-->
    <div class=\"modal-content\">
      <div class=\"modal-header\">
        <h4 class=\"modal-title module-modal-title\">Confirmar el cierre de sesión</h4>
        <button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>
      </div>
      <div class=\"modal-body\">
          <div class=\"row\">
              <div class=\"col-md-12\">
                  <p>
                    Estás a punto de salir de tu cuenta en Addons. Podrías perderte actualizaciones importantes de los Complementos que has comprado.
                  </p>
              </div>
          </div>
      </div>
      <div class=\"modal-footer\">
          <input type=\"button\" class=\"btn btn-default uppercase\" data-dismiss=\"modal\" value=\"Cancelar\">
          <a class=\"btn btn-primary uppercase\" href=\"/admin474ux0qz8chb1hhsqw9/index.php/modules/mbo/addons/logout?_token=pKeqTc0Y-JXys2x4E7GxPfqPN7Y2j0df67IwinThKRA\" id=\"module-modal-addons-logout-ack\">Sí, quiero salir</a>
      </div>

        </div>
    </div>
</div>

</div>
  

      <div class=\"bootstrap\">
      
    </div>
  
";
        // line 1361
        $this->displayBlock('javascripts', $context, $blocks);
        $this->displayBlock('extra_javascripts', $context, $blocks);
        $this->displayBlock('translate_javascripts', $context, $blocks);
        echo "</body>";
        echo "
</html>";
    }

    // line 110
    public function block_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_extra_stylesheets($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 1249
    public function block_content_header($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_content_footer($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_sidebar_right($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    // line 1361
    public function block_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_extra_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function block_translate_javascripts($context, array $blocks = [])
    {
        $macros = $this->macros;
    }

    public function getTemplateName()
    {
        return "__string_template__26ffe8ffd517d0410c9ce4fc0cfb0bfa7b5587412b42d12c292ce7085ee0fce0";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  1536 => 1361,  1515 => 1249,  1504 => 110,  1495 => 1361,  1460 => 1328,  1421 => 1291,  1373 => 1249,  1341 => 1219,  1290 => 1170,  1248 => 1130,  1215 => 1099,  1186 => 1072,  1153 => 1041,  1123 => 1013,  1092 => 984,  1055 => 949,  1021 => 917,  990 => 888,  959 => 859,  925 => 827,  894 => 798,  863 => 769,  831 => 739,  800 => 710,  761 => 673,  730 => 644,  696 => 612,  665 => 583,  633 => 553,  601 => 523,  566 => 490,  535 => 461,  491 => 419,  450 => 380,  400 => 332,  347 => 281,  301 => 237,  262 => 200,  243 => 183,  203 => 145,  163 => 110,  144 => 93,  119 => 70,  89 => 42,  46 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "__string_template__26ffe8ffd517d0410c9ce4fc0cfb0bfa7b5587412b42d12c292ce7085ee0fce0", "");
    }
}
