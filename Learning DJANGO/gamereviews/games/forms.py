from django import forms

class ReviewForm(forms.Form):
    game = forms.CharField(max_length=200, required=True)
    score = forms.IntegerField(min_value=0, max_value=100, required=True)
    essay = forms.CharField(widget=forms.Textarea, required=True)