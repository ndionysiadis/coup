<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhArchive, PhForkKnife, PhPlus } from "@phosphor-icons/vue";
import ProductCard from "@/Models/ProductCard.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";
import EmptyState from "@/Components/EmptyStates/EmptyState.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";

const title = "Προϊόντα";

const props = defineProps<{
    products: LaravelPaginator<App.Data.Product.ProductData>;
    term: App.Data.Product.ProductPageData;
}>();

//@ts-ignore
const term = ref<string>(props.term!);

watch(
    term,
    debounce((value) => {
        let fullUrl: string = window.location.href;
        let url: URL = new URL(fullUrl);
        let params: URLSearchParams = new URLSearchParams(url.search);

        params.set("term", value);

        url.search = params.toString();
        router.get(
            url.href,
            {},
            {
                preserveState: true,
                only: ["products"],
            },
        );
    }, 1000),
);
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingLarge>{{ title }}</HeadingLarge>
                    <PaginationMeta :meta="products.meta" />
                </div>

                <div class="flex items-center gap-2">
                    <PaginationLinks
                        v-if="products?.meta?.total > 0"
                        :links="products.links"
                    />

                    <AppLink :href="route('product.create')" title="Δημιουργία">
                        <IconPrimaryButton>
                            <PhPlus weight="bold" size="16" />
                        </IconPrimaryButton>
                    </AppLink>

                    <AppLink :href="route('product.archived')" title="Αρχείο">
                        <SecondaryButtonIcon>
                            <template #icon>
                                <PhArchive weight="fill" size="16" />
                            </template>

                            Αρχείο
                        </SecondaryButtonIcon>
                    </AppLink>
                </div>
            </div>

            <template v-if="products.meta.total > 0">
                <FormSearch
                    :clear-route="route('product.index')"
                    v-model="term"
                />

                <div class="flex flex-col gap-2">
                    <ProductCard
                        v-for="product in products.data"
                        :key="product.id!"
                        :product="product"
                    />
                </div>
            </template>

            <EmptyState v-else>
                <template #icon>
                    <PhForkKnife size="44" />
                </template>
                <template #content>
                    Φαίνεται πως δεν υπάρχουν ενεργά προϊόντα
                </template>
                <template #action>
                    <AppLink :href="route('product.create')" title="Δημιουργία">
                        <PrimaryButtonIcon>
                            <template #icon>
                                <PhPlus weight="bold" size="16" />
                            </template>

                            Προσθήκη
                        </PrimaryButtonIcon>
                    </AppLink>
                </template>
            </EmptyState>
        </div>
    </AuthenticatedLayout>
</template>
