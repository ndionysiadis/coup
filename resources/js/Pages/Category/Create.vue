<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import { PhArrowUUpLeft, PhFloppyDiskBack } from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import ComboboxSelector from "@/Components/Selectors/ComboboxSelector.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";

const props = defineProps<{
    category: App.Data.Category.CategoryData;
}>();

const title = "Δημιουργία κατηγορίας";

const form = useForm<App.Data.Category.CategoryData & { create_new: boolean }>(
    "post",
    route("category.store"),
    {
        ...props.category,
        create_new: false,
    },
);

const submitForm = (createNew: boolean) => {
    form.create_new = createNew;
    form.submit({
        preserveState: true,
        preserveScroll: true,
        onSuccess: () => {
            if (createNew) {
                form.reset();
                form.clearErrors();
            }
        },
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <template #breadcrumbs>
            <Breadcrumbs>
                <Breadcrumb first :href="route('category.index')">
                    Κατηγορίες
                </Breadcrumb>

                <Breadcrumb :href="route('category.create')">
                    Δημιουργία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('category.index')">
                    <IconSecondaryButton title="Επιστροφή">
                        <PhArrowUUpLeft weight="bold" />
                    </IconSecondaryButton>
                </AppLink>
            </div>
        </div>

        <form @submit.prevent="submitForm(false)">
            <CardContainer class="flex flex-col gap-4">
                <FormInput
                    id="text"
                    type="text"
                    label="Όνομα"
                    :required="true"
                    :autofocus="false"
                    :error="form.errors.name"
                    v-model="form.name"
                />

                <FormInput
                    id="description"
                    type="text"
                    label="Περιγραφή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.description"
                    v-model="form.description"
                />

                <ComboboxSelector
                    api
                    id="products"
                    v-model="form.products"
                    multiple
                    label="Προϊόντα"
                    :display-value-function="
                        (x: App.Data.Product.ProductData) => x?.name
                    "
                    :route="route('api.product.index')"
                    :error="form.errors.products"
                />

                <ComboboxSelector
                    api
                    id="menu"
                    v-model="form.menuType"
                    label="Κατάλογος"
                    :display-value-function="
                        (x: App.Data.Menu.MenuTypeData) => x?.name
                    "
                    :route="route('api.menu.index')"
                    :error="form.errors.menuType"
                />

                <div class="flex items-center gap-2">
                    <PrimaryButtonIcon
                        type="button"
                        title="Αποθήκευση & δημιουργία νέου"
                        @click="submitForm(true)"
                    >
                        <template #icon>
                            <PhFloppyDiskBack weight="fill" size="16" />
                        </template>
                        Αποθήκευση & δημιουργία νέου
                    </PrimaryButtonIcon>

                    <SecondaryButtonIcon type="submit" title="Αποθήκευση">
                        <template #icon>
                            <PhFloppyDiskBack weight="fill" size="16" />
                        </template>
                        Αποθήκευση
                    </SecondaryButtonIcon>
                </div>
            </CardContainer>
        </form>
    </AuthenticatedLayout>
</template>
