# Generated by Django 4.1 on 2024-06-28 08:30

from django.db import migrations, models


class Migration(migrations.Migration):
    dependencies = [
        ("games", "0001_initial"),
    ]

    operations = [
        migrations.AlterField(
            model_name="review",
            name="game",
            field=models.CharField(max_length=200),
        ),
    ]