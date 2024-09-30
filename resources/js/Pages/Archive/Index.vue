<script setup lang="ts">
import { Head, router } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import { ref, watch } from "vue";
import debounce from "lodash/debounce";

const title = "Αρχείο";

const props = defineProps<{
    archivedMenus: LaravelPaginator<App.Data.Archive.ArchiveData>;
    archivedCategories: LaravelPaginator<App.Data.Archive.ArchiveData>;
    archivedProducts: LaravelPaginator<App.Data.Archive.ArchiveData>;
    term: App.Data.Archive.ArchiveIndexPageData;
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
                only: ["archives"],
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
                <Breadcrumb first :href="route('archive.index')">
                    Αρχείο
                </Breadcrumb>
            </Breadcrumbs>
        </template>
        <!--        <div class="space-y-4">-->
        <!--            <div class="flex items-center justify-between">-->
        <!--                <div class="flex flex-col">-->
        <!--                    <HeadingLarge>{{ title }}</HeadingLarge>-->
        <!--                    <PaginationMeta :meta="menuTypes.meta" />-->
        <!--                </div>-->

        <!--                <div class="flex items-center gap-2">-->
        <!--                    <PaginationLinks-->
        <!--                        v-if="menuTypes?.meta?.total > 0"-->
        <!--                        :links="menuTypes.links"-->
        <!--                    />-->

        <!--                    <div class="flex items-center gap-2">-->
        <!--                        <SecondaryButtonIcon>-->
        <!--                            <template #icon>-->
        <!--                                <PhArchive weight="fill" size="16" />-->
        <!--                            </template>-->

        <!--                            <template #default> Αρχείο </template>-->
        <!--                        </SecondaryButtonIcon>-->

        <!--                        <AppLink-->
        <!--                            :href="route('menu.create')"-->
        <!--                            title="Δημιουργία"-->
        <!--                        >-->
        <!--                            <IconPrimaryButton>-->
        <!--                                <PhPlus weight="bold" size="16" />-->
        <!--                            </IconPrimaryButton>-->
        <!--                        </AppLink>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--            <FormSearch :clear-route="route('menu.index')" v-model="term" />-->

        <!--            <div class="flex flex-col gap-2">-->
        <!--                <MenuCard-->
        <!--                    v-for="menuType in menuTypes.data"-->
        <!--                    :key="menuType.id!"-->
        <!--                    :menu-type="menuType"-->
        <!--                />-->
        <!--            </div>-->
        <!--        </div>-->
    </AuthenticatedLayout>
</template>
