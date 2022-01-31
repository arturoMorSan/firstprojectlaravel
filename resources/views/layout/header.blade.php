<site-menu
    :breakpoint="1000"
    :links="{
        'Programa': '#programa',
        'Categorias': '#categorias',
        'Registro': '#registro',
    }"
    :authuser="{{ json_encode($authUser) }}"
>
    <template slot="close">
        Cerrar @svg('x', 'main-menu__close-icon')
    </template>
</site-menu>
