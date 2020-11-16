<style type="text/css">
    .header-shortcut-menu {
        position: absolute;
        top: 30px;
        left: 0;
        display: none;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
        background-color: #fff;
        border-radius: 6px;
        border-top-left-radius: 0;
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
        list-style: none;
        margin: 0;
        overflow: hidden;
        padding: 0;
        z-index: 2051;
    }

    .header-shortcut-menu:hover + .menu-recipe-link,
    .header-shortcut-menu:focus + .menu-recipe-link {
        background-color: #c70808;
        border-radius: 4px;
        border-bottom-left-radius: 0;
        color: #fff;
    }

    .header-shortcut-menu .col {
        display: inline-block;
        border-right: 1px solid #eee;
        min-width: 140px;
        padding: 4px 0 8px;
        width: 100%;
    }

    .header-shortcut-menu .col ul {
        display: block;
        font-size: 0;
        list-style: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .header-shortcut-menu .col li {
        display: block;
        font-size: 0;
        margin: 0;
        padding: 0;
        width: 100%;
    }

    .header-shortcut-menu .col a,
    .header-shortcut-menu .col .col-header {
        display: block;
        line-height: 28px;
        padding: 0 20px !important;
        text-decoration: none;
        white-space: nowrap;
        width: 100%;
    }

    .header-shortcut-menu .col a {
        background-color: white !important;
        color: #333 !important;
        font-size: 12px;
        font-weight: 300;
    }

    .header-shortcut-menu .col a:hover,
    .header-shortcut-menu .col a:focus {
        background-color: transparent !important;
        color: #d43f3a !important;
        cursor: pointer;
        text-decoration: none;
    }

    .header-shortcut-menu .col .col-header {
        color: #000;
        font-size: 13px;
        font-weight: 600;
    }

    .header-shortcut-menu .col .col-header:hover,
    .header-shortcut-menu .col .col-header:focus {
        cursor: default;
    }

    .menu-recipe:hover > .header-shortcut-menu {
        display: flex !important;
    }

    .menu-recipe:hover > .menu-recipe-link {
        border-bottom-left-radius: 0 !important;
    }
</style>
    {{ partial('home/head') }}
    {{ content() }}
