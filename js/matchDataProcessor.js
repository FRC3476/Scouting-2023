function roundInt(val) {
	return Math.round((val + Number.EPSILON) * 100) / 100;
}

function getProblematicCannedCommentMatchCount(data){
	var problematicComments = ['Tipped', 'Stuck on Charge Station', 'Didn\'t Move', 'Broken', 'Did Not Show Up', 'Bumpers Fell Off'];
	var commentDict = getCannedCommentsDictionary(data);
	var matchList = [];
	for (var i = 0; i != problematicComments.length; i++){
		var comment = problematicComments[i];
		if (comment in commentDict){
			matchList = [...matchList, ...commentDict[comment]];
		}
	}
	var matchSet = new Set(matchList);
	return matchSet.size;
}

function getCannedCommentsDictionary(data) {
	/* Returns a mapping of comment to list of matches */
	var commentLookup = {};
	for (var i = 0; i != data.length; i++) {
		var row = data[i];
		if (row['cannedComments'] === '' || row['cannedComments'] == 0) {
			continue;
		}
		var cannedSplit = row['cannedComments'].split(',');
		for (var j = 0; j != cannedSplit.length; j++) {
			var comment = cannedSplit[j];
			if (!(comment in commentLookup)) {
				commentLookup[comment] = [];
			}
			commentLookup[comment].push(row['matchNumber']);
		}
	}
	return commentLookup;
}

function getWrittenComments(data) {
	var comments = [];
	for (var i = 0; i != data.length; i++) {
		var row = data[i];
		if (row['textComments'] === '') {
			continue;
		}
		comments.push(row['textComments']);
		comments.push("Match " + row['matchNumber'] + ": ");
	}
	return comments;
}

function getMobilityAuto(row) {
	return row['autoMobility'] === 1;
}

function getEngageTeleop(row) {
	return row['teleopChargeStation'] == 'ENGAGED';
}

function getDockTeleop(row) {
	return row['teleopChargeStation'] == 'DOCKED';
}

function getParkTeleop(row) {
	return row['teleopChargeStation'] == 'COMMUNITY';
}

function getDockAuto(row) {
	if(row['autoChargeStation'] == 'DOCKED'){
		return 1;
	}else{
		return 0;
	}
}

function getEngageAuto(row) {
	if(row['autoChargeStation'] == 'ENGAGED'){
		return 1;
	}else{
		return 0;
	}
}

function getAutoChargeStationPoints(row){
	var points = 0;
	points += getDockAuto(row) ? 8 : 0;
	points += getEngageAuto(row) ? 12 : 0;
	return points;
}

function getTeleopChargeStationPoints(row){
	var points = 0;
	points += getDockTeleop(row) ? 6 : 0;
	points += getEngageTeleop(row) ? 10 : 0;
	return points;
}

function getTopAuto(row) {
	return row['autoConeLevel3'] + row['autoCubeLevel3'];
}
function getMiddleAuto(row) {
	return row['autoConeLevel2'] + row['autoCubeLevel2'];
}
function getBottomAuto(row) {
	return row['autoConeLevel1'] + row['autoCubeLevel1'];
}

function getTopTeleop(row) {
	return row['teleopConeLevel3'] + row['teleopCubeLevel3'];
}
function getMiddleTeleop(row) {
	return row['teleopConeLevel2'] + row['teleopCubeLevel2'];
}
function getBottomTeleop(row) {
	return row['teleopConeLevel1'] + row['teleopCubeLevel1'];
}

function getCubesAuto(row) {
	return (
		row['autoCubeLevel3'] + row['autoCubeLevel2'] + row['autoCubeLevel1']
	);
}
function getCubesTeleop(row) {
	return (
		row['teleopCubeLevel3'] +
		row['teleopCubeLevel2'] +
		row['teleopCubeLevel1']
	);
}

function getConesAuto(row) {
	return (
		row['autoConeLevel3'] + row['autoConeLevel2'] + row['autoConeLevel1']
	);
}
function getConesTeleop(row) {
	return (
		row['teleopConeLevel3'] +
		row['teleopConeLevel2'] +
		row['teleopConeLevel1']
	);
}

function getCones(row){
	return getConesAuto(row) + getConesTeleop(row);
}

function getCubes(row){
	return getCubesAuto(row) + getCubesTeleop(row);
}

function getPiecesAuto(row) {
	return getConesAuto(row) + getCubesAuto(row);
}
function getPiecesTeleop(row) {
	return getConesTeleop(row) + getCubesTeleop(row);
}

function getMatchPointsAuto(row) {
	var points = 0;
	if (getMobilityAuto(row)) {
		points += 3;
	}
	if (getDockAuto(row)) {
		points += 8;
	}
	if (getEngageAuto(row)) {
		points += 12;
	}
	points += 3 * getBottomAuto(row);
	points += 4 * getMiddleAuto(row);
	points += 6 * getTopAuto(row);
	return points;
}

function getMatchPointsTeleop(row) {
	var points = 0;
	if (getDockTeleop(row)) {
		points += 6;
	}
	if (getEngageTeleop(row)) {
		points += 10;
	}
	if (getParkTeleop(row)){
		points += 2;
	}
	points += 2 * getBottomTeleop(row);
	points += 3 * getMiddleTeleop(row);
	points += 5 * getTopTeleop(row);
	return points;
}

function getMatchPoints(row) {
	var points = 0;
	if (getMobilityAuto(row)) {
		points += 3;
	}
	if (getDockAuto(row)) {
		points += 8;
	}
	if (getEngageAuto(row)) {
		points += 12;
	}
	if (getDockTeleop(row)) {
		points += 6;
	}
	if (getEngageTeleop(row)) {
		points += 10;
	}
	if (getParkTeleop(row)){
		points += 2;
	}
	points += 3 * getBottomAuto(row);
	points += 4 * getMiddleAuto(row);
	points += 6 * getTopAuto(row);
	points += 2 * getBottomTeleop(row);
	points += 3 * getMiddleTeleop(row);
	points += 5 * getTopTeleop(row);
	return points;
}

function getWeightedScore(row) {
	var weightedScore = 0;
	if (getTopAuto(row)) {
		weightedScore += 6;
	}
	if (getMiddleAuto(row)) {
		weightedScore += 4;
	}
	if (getBottomAuto(row)) {
		weightedScore += 3;
	}
	if (getTopTeleop(row)) {
		weightedScore += 5;
	}
	if (getMiddleTeleop(row)) {
		weightedScore += 3;
	}
	if (getBottomTeleop(row)){
		weightedScore += 2;
	}
	if (getEngageTeleop(row)) {
		weightedScore += 10;
	}
	if (getDockTeleop(row)) {
		weightedScore += 6;
	}
	if (getParkTeleop(row)) {
		weightedScore += 2;
	}
	if (getEngageAuto(row)) {
		weightedScore += 12;
	}
	if (getDockAuto(row)) {
		weightedScore += 8;
	}
	if (getMobilityAuto(row)){
		weightedScore += 3;
	}
	weightedScore += 4 * getTopAuto(row);
	weightedScore += 3 * getMiddleAuto(row);
	weightedScore += 2 * getBottomAuto(row);
	weightedScore += 2.5 * getTopTeleop(row);
	weightedScore += 1.75 * getMiddleTeleop(row);
	weightedScore += 1 * getBottomTeleop(row);
	weightedScore += 3 * getEngageTeleop(row);
	weightedScore += 2 * getDockTeleop(row);
	weightedScore += 0.5 * getParkTeleop(row);
	weightedScore += 4 * getEngageAuto(row);
	weightedScore += 2 * getDockAuto(row);
	weightedScore += 2 * getMobilityAuto(row);
	return weightedScore;
}

function getMatchGamePiece(row) {
	return getPiecesAuto(row) + getPiecesTeleop(row);
}

function getTopConesAuto(row) {
	return row['autoConeLevel3'];
}
function getMiddleConesAuto(row) {
	return row['autoConeLevel2'];
}
function getBottomConesAuto(row) {
	return row['autoConeLevel1'];
}

function getTopCubesAuto(row) {
	return row['autoCubeLevel3'];
}
function getMiddleCubesAuto(row) {
	return row['autoCubeLevel2'];
}
function getBottomCubesAuto(row) {
	return row['autoCubeLevel1'];
}

//Teleop
function getTopConesTeleop(row) {
	return row['teleopConeLevel3'];
}
function getMiddleConesTeleop(row) {
	return row['teleopConeLevel2'];
}
function getBottomConesTeleop(row) {
	return row['teleopConeLevel1'];
}

function getTopCubesTeleop(row) {
	return row['teleopCubeLevel3'];
}
function getMiddleCubesTeleop(row) {
	return row['teleopCubeLevel2'];
}
function getBottomCubesTeleop(row) {
	return row['teleopCubeLevel1'];
}