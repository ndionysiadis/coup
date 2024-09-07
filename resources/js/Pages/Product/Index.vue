<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import {PhPlus} from "@phosphor-icons/vue";
import ProductCard from "@/Models/ProductCard.vue";

const title = "Προϊόντα"

const props = defineProps<{
    products: LaravelPaginator<App.Data.ProductData>
}>()
</script>

<template>
    <Head :title="title"/>

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="flex items-center justify-between mb-4">
            <div class="flex flex-col">
                <HeadingLarge>{{ title }}</HeadingLarge>
                <PaginationMeta :meta="products.meta"/>
            </div>

            <div class="flex items-center gap-2">
                <PaginationLinks
                    v-if="products?.meta?.total > 0"
                    :links="products.links"/>

                <AppLink :href="route('product.create')">
                    <PrimaryButtonIcon direction="right">
                        <template #icon>
                            <PhPlus weight="bold" size="16"/>
                        </template>

                        Δημιουργία
                    </PrimaryButtonIcon>
                </AppLink>
            </div>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-2">
            <ProductCard
                v-for="product in products.data"
                :key="product.id"
                :product="product"/>
        </div>
    </AuthenticatedLayout>
</template>
