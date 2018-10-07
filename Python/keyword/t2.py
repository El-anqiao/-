# -*- coding: utf-8 -*-
from __future__ import print_function
from __future__ import unicode_literals




from snownlp import normal
from snownlp import seg
from snownlp.summary import textrank
import re
from html.parser import HTMLParser
import html

text='''
Children Kids Rain Proof Wear-resisting Anti-Slip Shoe Cover S(Blue Sports)
'''
text=html.unescape(text)
dr = re.compile(r'<[^>]+>',re.S)
text = dr.sub('',text)

if __name__ == '__main__':
    t = normal.zh2hans(text)
    sents = normal.get_sentences(t)
    doc = []
    for sent in sents:
        words = seg.seg(sent)
        words = normal.filter_stop(words)
        doc.append(words)
    rank = textrank.TextRank(doc)
    rank.solve()
    for index in rank.top_index(10):
        print(sents[index])
    keyword_rank = textrank.KeywordTextRank(doc)
    keyword_rank.solve()
    for w in keyword_rank.top_index(10):
        print(w)