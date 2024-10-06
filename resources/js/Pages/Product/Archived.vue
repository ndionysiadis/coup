<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhArrowLeft, PhForkKnife } from "@phosphor-icons/vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import EmptyState from "@/Components/EmptyStates/EmptyState.vue";
import ArchiveProductCard from "@/Models/ArchiveProductCard.vue";

const title = "Αρχείο";

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
                only: ["menuTypes"],
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

                <Breadcrumb :href="route('product.archived')">
                    Αρχείο
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

                    <AppLink :href="route('product.index')" title="Επιστροφή">
                        <IconSecondaryButton>
                            <PhArrowLeft weight="bold" size="16" />
                        </IconSecondaryButton>
                    </AppLink>
                </div>
            </div>

            <template v-if="products.meta.total > 0">
                <FormSearch
                    :clear-route="route('product.archived')"
                    v-model="term"
                />

                <div class="flex flex-col gap-2">
                    <ArchiveProductCard
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
                    Φαίνεται πως δεν υπάρχουν αρχειοθετημένα προϊόντα
                </template>
            </EmptyState>
        </div>
    </AuthenticatedLayout>
</template>
