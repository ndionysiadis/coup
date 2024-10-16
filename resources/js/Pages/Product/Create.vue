<script setup lang="ts">
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import HeadingLarge from "@/Components/Texts/HeadingLarge.vue";
import Breadcrumb from "@/Components/Pagination/Breadcrumb.vue";
import Breadcrumbs from "@/Components/Pagination/Breadcrumbs.vue";
import IconSecondaryButton from "@/Components/Buttons/IconSecondaryButton.vue";
import {
    PhArrowUUpLeft,
    PhCurrencyEur,
    PhFloppyDiskBack,
} from "@phosphor-icons/vue";
import AppLink from "@/Components/Links/AppLink.vue";
import { useForm } from "laravel-precognition-vue-inertia";
import FormInput from "@/Components/FormElements/FormInput.vue";
import CardContainer from "@/Components/Cards/CardContainer.vue";
import PrimaryButtonIcon from "@/Components/Buttons/PrimaryButtonIcon.vue";
import FormNumber from "@/Components/FormElements/FormNumber.vue";
import ComboboxSelector from "@/Components/Selectors/ComboboxSelector.vue";
import SecondaryButtonIcon from "@/Components/Buttons/SecondaryButtonIcon.vue";

const props = defineProps<{
    product: App.Data.Product.ProductData;
}>();

const title = "Δημιουργία προϊόντος";

const form = useForm<App.Data.Product.ProductData & { create_new: boolean }>(
    "post",
    route("product.store"),
    {
        ...props.product,
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
                <Breadcrumb first :href="route('product.index')">
                    Προϊόντα
                </Breadcrumb>

                <Breadcrumb :href="route('product.create')">
                    Δημιουργία
                </Breadcrumb>
            </Breadcrumbs>
        </template>

        <div class="mb-4 flex items-center justify-between">
            <div class="flex flex-col">
                <HeadingLarge> {{ title }}</HeadingLarge>
            </div>

            <div class="flex items-center gap-2">
                <AppLink :href="route('product.index')">
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

                <FormNumber
                    id="price"
                    step="0.1"
                    label="Τιμή"
                    :required="false"
                    :autofocus="false"
                    :error="form.errors.price"
                    v-model="form.price"
                >
                    <PhCurrencyEur weight="bold" />
                </FormNumber>

                <ComboboxSelector
                    api
                    id="category"
                    v-model="form.category"
                    label="Κατηγορία"
                    :display-value-function="
                        (x: App.Data.Category.CategoryData) => x?.name
                    "
                    :route="route('api.category.index')"
                    :error="form.errors.category"
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
