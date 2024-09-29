<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import PaginationMeta from "@/Components/Pagination/PaginationMeta.vue";
import MenuCard from "@/Models/MenuCard.vue";
import PaginationLinks from "@/Components/Pagination/PaginationLinks.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { PhPlus } from "@phosphor-icons/vue";
import IconPrimaryButton from "@/Components/Buttons/IconPrimaryButton.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";
import FormSearch from "@/Components/FormElements/FormSearch.vue";

const title = "Μενού";

const props = defineProps<{
    menuTypes: LaravelPaginator<App.Data.Menu.MenuTypeData>;
    term: App.Data.Menu.MenuTypeIndexPageData;
}>();

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
                <Breadcrumb first :href="route('menu.index')">
                    Μενού
                </Breadcrumb>
            </Breadcrumbs>
        </template>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex flex-col">
                    <HeadingLarge>{{ title }}</HeadingLarge>
                    <PaginationMeta :meta="menuTypes.meta" />
                </div>

                <div class="flex items-center gap-2">
                    <PaginationLinks
                        v-if="menuTypes?.meta?.total > 0"
                        :links="menuTypes.links"
                    />

                    <AppLink :href="route('menu.create')" title="Δημιουργία">
                        <IconPrimaryButton>
                            <PhPlus weight="bold" size="16" />
                        </IconPrimaryButton>
                    </AppLink>
                </div>
            </div>

            <FormSearch :clear-route="route('menu.index')" v-model="term" />

            <div class="flex flex-col gap-2">
                <MenuCard
                    v-for="menuType in menuTypes.data"
                    :key="menuType.id"
                    :menu-type="menuType"
                />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
