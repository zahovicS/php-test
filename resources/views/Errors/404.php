<?= view("Layouts.Header") ?>
<?= view("Layouts.Navbar") ?>

<div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <h1 class="text-2xl font-bold">Sorry. Page Not Found.</h1>

    <p class="mt-4">
        <a href="<?= route() ?>" class="text-blue-500 underline">Go back home.</a>
    </p>
</div>
<div id="app"></div>
<?= view("Layouts.Footer") ?>