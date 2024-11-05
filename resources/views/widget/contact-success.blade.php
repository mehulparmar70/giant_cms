<div class="enquiry_form_modal col-8" style="display:none; background: #0e7b1a; border-radius: 6px; 
border: 2px solid white;">
        <button type="button" class="btn-close pull-right" data-bs-dismiss="modal" aria-label="Close"></button>
            <h3 class="text-light">Thank you for showing interest in our work and sending 
        us the quote request. We will get back to you within 24 hours.</h3>
        
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<template>
  <div>
    <b-overlay :show="show" rounded="sm">
      <b-card title="Card with overlay" :aria-hidden="show ? 'true' : null">
        <b-card-text>Laborum consequat non elit enim exercitation cillum.</b-card-text>
        <b-card-text>Click the button to toggle the overlay:</b-card-text>
        <b-button :disabled="show" variant="primary" @click="show = true">
          Show overlay
        </b-button>
      </b-card>
    </b-overlay>
    <b-button class="mt-3" @click="show = !show">Toggle overlay</b-button>
  </div>
</template>