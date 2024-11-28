Schema::create('foto', function (Blueprint $table) {
    $table->id();
    $table->foreignId('galery_id')
          ->constrained('galery')
          ->onDelete('cascade');
    $table->string('file');
    $table->string('judul');
    $table->timestamps();
}); 