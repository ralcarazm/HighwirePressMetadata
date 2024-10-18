<?php
$dublinCoreElements = array(
    'Title', 'Alternative Title','Creator','Subject','Description', 'Abstract', 'Table Of Contents','Publisher','Contributor','Date', 'Date Created', 'Date Issued', 'Date Modified', 'Date Available', 'Date Valid','Type','Format', 'Medium', 'Extent','Identifier','Source','Language','Relation', 'Is Part Of', 'Has Part', 'Is Version Of', 'Is Format Of', 'Has Version',  'Has Format', 'Is Replaced By', 'Is Required By', 'References', 'Replaces', 'Requires','Coverage', 'Spatial Coverage', 'Temporal Coverage','Rights', 'Rights Holder', 'License', 'Access Rights', 'Conforms To','Audience', 'Mediator', 'Audience Education Level','Provenance','Bibliographic Citation','Accrual Method', 'Accrual Periodicity', 'Accrual Policy', 'Mediator', 'Instructional Method'
);

$highwireElements = array(
    'citation_title', 'citation_author', 'citation_publication_date', 'citation_journal_title',
    'citation_volume', 'citation_issue', 'citation_firstpage', 'citation_lastpage',
    'citation_doi', 'citation_abstract', 'citation_publisher', 'citation_issn',
    'citation_isbn', 'citation_language', 'citation_keywords', 'citation_pdf_url',
    'citation_fulltext_html_url', 'citation_dissertation_institution', 'citation_conference_title',
    'citation_patent_number', 'citation_url', 'citation_journal_abbrev', 'citation_author_institution'
);

$mapping = json_decode(get_option('highwire_press_mapping'), true);
?>

<h2>Dublin Core - Highwire Press Mapping</h2>

<?php foreach ($highwireElements as $highwireElement): ?>
    <div class="field">
        <label for="<?php echo $highwireElement; ?>"><?php echo $highwireElement; ?></label>
        <select name="highwire_mapping[<?php echo $highwireElement; ?>]" id="<?php echo $highwireElement; ?>">
            <option value="">Dublin Core Element</option>
            <?php foreach ($dublinCoreElements as $dcElement): ?>
                <option value="<?php echo $dcElement; ?>"
                    <?php echo (isset($mapping[$highwireElement]) && $mapping[$highwireElement] == $dcElement) ? 'selected' : ''; ?>>
                    <?php echo $dcElement; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
<?php endforeach; ?>
