<template>
    <nav aria-label="Table Navigation">
        <ul :class="wrapperClass">
            <li
                @click="loadPage(1)"
                class="{{ linkClass }} {{ isOnFirstPage ? disabledClass : '' }}">
                <a>
                    <i v-if="icons.first != ''" class="{{ icons.first }}"></i>
                    <span v-else>&laquo;</span>
                </a>
            </li>

            <li
                @click="loadPage('prev')"
                class="{{ linkClass }} {{ isOnFirstPage ? disabledClass : '' }}">
                <a>
                    <i v-if="icons.next != ''" class="{{ icons.prev }}"></i>
                    <span v-else>&lsaquo;</span>
                </a>
            </li>

            <template v-if="notEnoughPages">
                <template v-for="n in totalPage">
                    <li
                        @click="loadPage(n+1)"
                        class="{{ pageClass }} {{ isCurrentPage(n+1) ? activeClass : '' }}">
                        <a>
                            {{ n+1 }}
                        </a>
                    </li>
                </template>
            </template>

            <template v-else>
                <template v-for="n in windowSize">
                    <li
                        @click="loadPage(windowStart+n)"
                        class="{{ pageClass }} {{ isCurrentPage(windowStart+n) ? activeClass : '' }}">
                        <a>
                            {{ windowStart+n }}
                        </a>
                    </li>
                </template>
            </template>

            <li
                @click="loadPage('next')"
                class="{{ linkClass }} {{ isOnLastPage ? disabledClass : '' }}">
                <a>
                    <i v-if="icons.next != ''" class="{{ icons.next }}"></i>
                    <span v-else>&rsaquo;</span>
                </a>
            </li>

            <li
                @click="loadPage(totalPage)"
                class="{{ linkClass }} {{ isOnLastPage ? disabledClass : '' }}">
                <a>
                    <i v-if="icons.last != ''" class="{{ icons.last }}"></i>
                    <span v-else>&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    import PaginationMixin from 'vuetable/src/components/VuetablePaginationMixin.vue';

    export default {
        mixins: [PaginationMixin],
    }
</script>