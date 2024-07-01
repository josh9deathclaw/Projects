from django.db import models

#create a model for the review table
class Review(models.Model):
    id = models.AutoField(primary_key=True)
    game = models.CharField(max_length=200, unique=True)
    avg_score = models.DecimalField(db_column='avg_score', max_digits=5, decimal_places=2)

    class Meta:
        db_table = 'reviewscore'
        managed = False

class UserReview(models.Model):
    game = models.ForeignKey(Review, on_delete=models.CASCADE, to_field='game', db_column='game')
    score = models.IntegerField(db_column='user_score')
    essay = models.TextField()

    class Meta:
        db_table = 'userscore'
        managed = False
