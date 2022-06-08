<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center pt-3">
            <li class="page-item" :class="{ disabled: isInFirstPage }">
                <div class="page-link"  @click="onClickFirstPage">Inicio</div>
            </li>
            <!-- <li class="page-item" :class="{ disabled: isInFirstPage }">
                <button class="page-link"  @click="onClickPreviousPage">Previous</button>
            </li> -->
            <li class="page-item" v-for="page in pages" :key="page.name" :class="{ active: isPageActive(page.name) }">
                <div class="page-link" @click="onClickPage(page.name)" :disabled="page.isDisabled">{{ page.name
                }}</div>
            </li>

            <!-- <li class="page-item" :class="{ disabled: isInLastPage }">
                <button class="page-link" @click="onClickNextPage">Next</button>
            </li> -->
            <li class="page-item" :class="{ disabled: isInLastPage }">
                <div class="page-link"  @click="onClickLastPage">Final</div>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'pagination',
    props: {
        maxVisibleButtons: {
            type: Number,
            required: false,
            default: 3
        },
        totalPages: {
            type: Number,
            required: true
        },
        perPage: {
            type: Number,
            required: true
        },
        currentPage: {
            type: Number,
            required: true
        }
    },
    computed: {
        startPage() {
            // When on the first page
            if (this.currentPage === 1) {
                return 1;
            }

            // When on the last page
            if (this.currentPage === this.totalPages) {
                return this.totalPages - (this.maxVisibleButtons - 1);
            }

            // When inbetween
            return this.currentPage - 1;
        },
        pages() {
            const range = [];

            for (
                let i = this.startPage;
                i <= Math.min(this.startPage + this.maxVisibleButtons - 1, this.totalPages);
                i++
            ) {
                range.push({
                    name: i,
                    isDisabled: i === this.currentPage
                });
            }

            return range;
        },
        isInFirstPage() {
            return this.currentPage === 1;
        },
        isInLastPage() {
            return this.currentPage === this.totalPages;
        }
    },
    methods: {
        onClickFirstPage() {
            this.$emit('pagechanged', 1);
        },
        onClickPreviousPage() {
            this.$emit('pagechanged', this.currentPage - 1);
        },
        onClickPage(page) {
            this.$emit('pagechanged', page);
        },
        onClickNextPage() {
            this.$emit('pagechanged', this.currentPage + 1);
        },
        onClickLastPage() {
            this.$emit('pagechanged', this.totalPages);
        },
        isPageActive(page) {
            return this.currentPage === page;
        }
    }
}
</script>

<style scoped>
.page-item{
    cursor: pointer;
}
</style>