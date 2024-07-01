from django.shortcuts import render, redirect
from django.views.generic import TemplateView
from django.views import View
from games.models import Review, UserReview
from .forms import ReviewForm

class HomePageView(TemplateView):
    template_name = 'home.html'

class ReviewsView(View):
    # template_name = 'games/reviews.html'
    #method to list all of the columns in a table
    def get(self, request):
        context = {}

        reviews = Review.objects.all()
        context["reviews"] = reviews
        print(reviews)

        return render(request, "reviews.html", context)

class NewsView(TemplateView):
    template_name = 'news.html'

class WriteView(View):
    template_name = 'write.html'

    def get(self, request, *args, **kwargs):
        form = ReviewForm()
        return render(request, self.template_name, {'form': form})

    def post(self, request, *args, **kwargs):
        form = ReviewForm(request.POST)

        if form.is_valid():
            game_name = form.cleaned_data['game']
            score = form.cleaned_data['score']
            essay = form.cleaned_data['essay']

            review_instance, created = Review.objects.get_or_create(game=game_name)

            UserReview.objects.create(
                game=review_instance, score=score, essay=essay
            )

            return redirect('reviews')  # Redirect to reviews page after submission

        return render(request, self.template_name, {'form': form})


